<?php

namespace App\Models\Ticket;

use App\Models\Event\Event;
use App\Models\Payment\Payment;
use App\Models\People\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\ticketStatus;
use App\Models\Payment\Sadad;


class Ticket extends Model
{
    protected $fillable = [
        'name',
        'ticketStatus',
        'buyDate',
        'price',
        'userId',
        'eventId',
        'payment_id',
    ];

    protected $casts = [
        'ticketStatus' => ticketStatus::class,
    ];

    // returns all tickets saved in the tickets table method
    public  function getAllTickets() {
        return Ticket::all();
    }

    // returns all tickets saved in the tickets table for a specific customer method
    public static function getAllUserTickets($id) {
         return Ticket::where('userId', $id)->get();
    }

    public function getTicketsForMonth($startOfMonth, $endOfMonth)
    {
        return Ticket::whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        })->get();
    }

    public function checkIfTicketPurchased($event, $userId){
        return true;
    }


    public function calculateTotalTicketPrice($tickets)
    {
        return $tickets->sum(function ($ticket) {
            return $ticket->event->price; // Assuming event has a 'price' column
        });
    }


    public function getTicketByUserId($userId)
    {
        return Ticket::where('userId', $userId)->get();
    }
    //inserts ticket in the tickets table
    public static function createTicket($event ,$customer) {
        return self::create([
            'userId' => $customer->id,
            'eventId' => $event->id,
            'ticketStatus' => ticketStatus::INACTIVE,
        ]);
    }



    // userId Belongs To User
    public function user()
    {
        return $this->belongsTo(Customer::class, 'userId');
    }

    // eventId Belongs To Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }

    // paymentId Belongs To Payment
    public function payment()
    {
        return $this->belongsTo(Sadad::class, 'payment_id');  // This assumes the 'payment_id' column in 'tickets' references 'id' in 'payments'
    }

}
