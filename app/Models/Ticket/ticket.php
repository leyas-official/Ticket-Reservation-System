<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User\User;


class Ticket extends Model
{
    protected $fillable = [
        'name',
        'ticketStatus',
        'buyDate',
        'price',
        'userId',
        'eventId',
        'paymentId',
    ];

    public static function booking(Request $request) {

        $validatedData = self::validation($request);

        // Store User Data
        User::createUser($validatedData);

        // Store Ticket

        return redirect()->route('events')->with('success', 'Your booking has been successfully completed!');
    }

    public  static function validation(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'tickets' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:credit_card,sadad,mobicash',
        ]);

        return $validatedData ;
    }


    // userId Belongs To User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
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
