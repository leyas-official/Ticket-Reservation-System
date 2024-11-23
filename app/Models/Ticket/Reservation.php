<?php

namespace App\Models\Ticket;

use App\Enums\ticketStatus;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use App\Models\Payment\Idfali;
use App\Models\Payment\Sadad;
use App\Models\Payment\MobiCash;
use App\Enums\paymentStatus;

class Reservation
{
    // add booking to the user account
    // call the payment process to check if the payment is successful
    public static function hundlePurchaseProcedures(Request $request, $ticket, $paymentType){
        try {
            if ($paymentType) { // Check if payment type is provided
                $payment = self::getPaymentProcessor($paymentType);
                if ($payment && $payment->handleRequest($request, $ticket)) {// Process payment and check if successful
                    return redirect()->route('myCart')->with('success', 'Purchase successful using ' . $paymentType .'.');
                } else {
                    return redirect()->route('myCart')->with('error', 'Payment failed. Please try again.'); // Handle payment failure
                }
            } else {
                return redirect()->route('myCart')->with('error', 'Payment type not specified.'); // Handle missing payment type
            }
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('myCart', 'Failed to reserve a ticket. Please try again later.');
        }
    }

    // returns with the directory for the class that going to process the payment
    public static function getPaymentProcessor($paymentType){
        $models = [
            'Sadad' => Sadad::class,
            'MobiCash' => MobiCash::class,
            'Edf3li' => Idfali::class,
        ];

        if (array_key_exists($paymentType, $models)) {
            $modelClass = $models[$paymentType];
            return new $modelClass();
        } else {
            return null;
        }
    }


    //cancel and deletes customer reservation/booking and refunds customer money
    public static function hundleRefundProcedures($ticket)
    {
        try {
            $paymentType = $ticket->payment->paymentType;
            $payment = self::getPaymentProcessor($paymentType);
            if ($payment && $payment->processRefund()) {
                $ticket->payment->status = paymentStatus::REFUNDED;
                $ticket->payment->save();
                $ticket->delete();
                return redirect()->route('myCart')->with('success', 'Refund successful to your ' . $paymentType . ' account.');
            } else {
                return redirect()->route('myCart')->with('error', 'Error occurred during the refund process, Please try again.');
            }
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to cancel reservation. Please try again later.');
        }
    }
//    public static completePurchased(){ return}
}
