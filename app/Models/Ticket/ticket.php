<?php

namespace App\Models\Ticket;

use App\Models\Event\Event;
use App\Models\Payment\Payment;
use App\Models\People\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\ticketStatus;


class Ticket extends Model
{
    protected $fillable = [
        'name',
        'ticketStatus',
        'buyDate',
        'price',
        'userId',
        'eventId',
        'paymentType',
    ];

    protected $casts = [
        'ticketStatus' => ticketStatus::class,
    ];




    public static function getAllTickets() {
        return Ticket::all();
    }

    public static function getAllUserTickets($id) {
         return Ticket::where('userId', $id)->get();
    }

    public static function getTicketByID($id) {
        return Ticket::where('id', $id)->first();
    }

    public static function createTicket($data, $T_data) {
        return self::create([
            'userId' => $data['userId'],
            'eventId' => $data['eventId'],
            'paymentType' => $data['payment_method'],
            'ticketStatus' => $T_data,
        ]);
    }

    public static function deleteTicket($data)
    {
        $data->delete();
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
        return $this->belongsTo(Payment::class, 'paymentId');
    }
}
