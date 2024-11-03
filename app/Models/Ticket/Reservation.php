<?php

namespace App\Models\Ticket;

use App\Enums\ticketStatus;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;

class Reservation
{
    public static function reservation(Request $request) {

        $paymentType = $request->input('payment_method');

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

    }

    public static function getPaymentProcessor(string $paymentType): ?Payment
    {
        $className = ucfirst(strtolower($paymentType)); // Normalize payment type to class name format (e.g., "debtcard" -> "Debtcard")

        $fullyQualifiedClassName = 'App\\Models\\Payment\\' . $className; // Assuming payment classes are in the same namespace

        if (class_exists($fullyQualifiedClassName) && is_subclass_of($fullyQualifiedClassName, Payment::class)) {
            return new $fullyQualifiedClassName();
        }

        return null; // Return null if the class doesn't exist or isn't a subclass of Payment
    }

    public static function cancelReservation(Request $request) {
        $ticketData = Ticket::getTicketByID($request->input('ticket_id'));
        Ticket::deleteTicket($ticketData);
        return redirect()->route('userTickets')->with('success', 'Your Reservation has been successfully Canceled.');
    }

        //      public  static function validation(Request $request) {
        ////        dd($request);
        //        return $request->validate([
        //            'userId' => 'required|integer|min:5|exists:customers,id',
        //            'eventId' => 'required|integer|min:5|exists:tickets,id',
        //            'name' => 'required|string|max:255|exists:customers,name',
        //            'email' => 'required|email|exists:customers,email'
        //        ]);
        //    }
}
