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
                if ($payment) {
                    $validatedData = $payment->validation($request);
                    if ($validatedData instanceof \Illuminate\Http\RedirectResponse) {
                        return $validatedData;
                    }
                    if ($payment->handleRequest($request, $ticket)) { // Process payment
                        return redirect()->route('myCart')->with('success', 'Purchase successful using ' . $paymentType . '.');
                    } else {
                        return redirect()->route('myCart')->with('error', 'Payment failed. Please try again.');
                    }
                } else {
                    return redirect()->route('myCart')->with('error', 'Invalid payment type selected.'); // More specific error message
                }
            } else {
                return redirect()->route('myCart')->with('error', 'Payment type not specified.');
            }
        }catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage()); // Log the error for debugging
            return redirect()->route('myCart')->with('error', 'Failed to purchase the ticket. Please try again.'); // Redirect with error message
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
                $payment->updateToRefunded($ticket);
                return redirect()->route('myCart')->with('success', 'Refund successful to your ' . $paymentType . ' account.');
            } else {
                return redirect()->route('myCart')->with('error', 'Error occurred during the refund process, Please try again.');
            }
        } catch (\Exception $e){
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to cancel reservation. Please try again later.');
        }
    }
//    public static completePurchased(){ return}
}
