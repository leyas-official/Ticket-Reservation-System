<?php

namespace App\Models\Ticket;

use App\Enums\ticketStatus;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;

class Reservation
{
    // add booking to the user account
    public static function addReservation(Request $request) {
        $paymentType = $request->input('payment_method');

        try {
            if ($paymentType) { // Check if payment type is provided
                $payment = self::getPaymentProcessor($paymentType);
                if ($payment && $payment->processPayment()) { // Process payment and check if successful
                    $T_data = TicketStatus::ACTIVE->value;
                    Ticket::createTicket($request, $T_data);
                    return redirect()->route('events')->with('success', 'Your booking has been successfully completed using ' . $paymentType .'.');
                } else {
                    return redirect()->route('events')->with('error', 'Payment failed. Please try again.'); // Handle payment failure
                }
            } else {
                return redirect()->route('events')->with('error', 'Payment type not specified.'); // Handle missing payment type
            }
        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to reserve a ticket. Please try again later.');
        }

    }

    // returns with the directory for the class that going to process the payment
    public static function getPaymentProcessor(string $paymentType): ?Payment
    {
        $className = ucfirst(strtolower($paymentType)); // Normalize payment type to class name format (e.g., "debtcard" -> "Debtcard")

        $fullyQualifiedClassName = 'App\\Models\\Payment\\' . $className; // Assuming payment classes are in the same namespace

        if (class_exists($fullyQualifiedClassName) && is_subclass_of($fullyQualifiedClassName, Payment::class)) {
            return new $fullyQualifiedClassName();
        }

        return null; // Return null if the class doesn't exist or isn't a subclass of Payment
    }



    //cancel and deletes customer reservation/booking and refunds customer money
    public static function cancelReservation($ticketId)
    {
        try {
            $ticket = Ticket::where('id', $ticketId)->first();
            $paymentType = $ticket->paymentType;
            $payment = self::getPaymentProcessor($paymentType);
            if ($payment && $payment->processRefund()) {
                //IMPORTANT : YOU DONT NEED TO GO TO CLASS TICKET TO PROCESS THE DELETE YOU CAN JUST DO IT HERE WITH ->delete()
                $ticket->delete();
                return redirect()->route('myTickets')->with('success', 'Your booking has been cancelled.');
            } else {
                return redirect()->route('myTickets')->with('error', 'Error occurred during the refund process, Please try again.');
            }
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to cancel reservation. Please try again later.');
        }
    }
}