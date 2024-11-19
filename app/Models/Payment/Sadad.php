<?php

namespace App\Models\Payment;
use App\Enums\ticketStatus;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules\Enum;


class Sadad extends Model implements Payment
{
    protected $fillable = [
        'name',
        'amount',
        'paymentType',
        'paymentDate',
    ];

    protected $table = 'payments';
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
//                dd($ticket);
        self::validation($request);
        self::processPayment();
        self::store($request,$ticket);
        return redirect()->route('myCart')->with('success', 'purchased Ticket Is Successful');
    }

    public static function validation($request)
    {
        return $request->validate([
            'fullName' => 'required|min:3|max:50',
            'cardNumber' => 'required|numeric',
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
            'name' => $request->fullName,
            'amount' => $ticket->event->price,
            'paymentDate' => now(),
            'paymentType' => 'Sdad',
        ]);
    }
}
