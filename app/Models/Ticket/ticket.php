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

    public static function booking(Request $request) {

        $validatedData = self::validation($request);

        // Store User Data
        Customer::createUser($validatedData);

        // Store Ticket

        return redirect()->route('events')->with('success', 'Your booking has been successfully completed!');
    }

//    public  static function validation(Request $request) {
////        dd($request);
//        return $request->validate([
//            'userId' => 'required|integer|min:5|exists:customers,id',
//            'eventId' => 'required|integer|min:5|exists:tickets,id',
//            'name' => 'required|string|max:255|exists:customers,name',
//            'email' => 'required|email|exists:customers,email',
//            'payment_method' => 'required|string|exists:credit_card,sadad,mobicash',
//        ]);
//    }

    public static function getAllTickets() {
        return Ticket::all();
    }

    public static function getAllUserTickets($id) {
         return Ticket::where('userId', $id)->get();
    }

    public static function getTicketByID($id) {
        return Ticket::where('id', $id)->first();
    }

    public static function addTicket(Request $request) {
//        $validatedData = self::validation($request);
        $T_data = TicketStatus::ACTIVE->value;
        self::createTicket($request, $T_data);
        return redirect()->route('events')->with('success', 'Purchase has been successfully completed!');
    }

    public static function cancelReservation(Request $request) {

    }

    public static function createTicket($data, $T_data) {
//        dd($data->all());
        return self::create([
            'userId' => $data['userId'],
            'eventId' => $data['eventId'],
            'paymentType' => $data['payment_method'],
            'ticketStatus' => $T_data,
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
        return $this->belongsTo(Payment::class, 'paymentId');
    }
}
