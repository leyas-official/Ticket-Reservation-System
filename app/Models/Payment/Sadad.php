<?php

namespace App\Models\Payment;
use App\Enums\ticketStatus;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules\Enum;


class Sadad extends Model implements Payment
{
    protected $table = 'payments';

    protected $fillable = [
        'name',
        'amount',
        'paymentType',
        'paymentDate',
        'ticketId',
    ];

    //fake methods
    public function processPayment()
    {
        return True;
    }

    public function processRefund()
    {
        return True;
    }

    public function getAllPayment()
    {
        // TODO: Implement getAllPayment() method.
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function handleRequest($request,$ticket)
    {
        self::validation($request);
        self::processPayment();
        self::store($request,$ticket);
        return redirect()->route('myCart')->with('success', 'purchased Ticket Is Successful using Sadad');
    }

    public static function validation($request)
    {
        return $request->validate([
            'fullName' => 'required|min:3|max:50',
            'phoneNumber' => 'required|numeric',
            'cardExpiration' => 'required|date|after:today',
            'discountType' => 'required',
        ]) ;
    }

    public static function store($request,$ticket)
    {

        $ticket->update([
            'ticketStatus' => ticketStatus::USED,
        ]);


        return self::create([
            'name' => $ticket->user->name,
            'amount' => $ticket->event->price,
            'paymentDate' => now(),
            'paymentType' => 'Sdad',
            'ticketId' => $ticket->id,
        ]);
    }
}
