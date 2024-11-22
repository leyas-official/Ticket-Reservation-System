<?php

namespace App\Models\Payment;
use App\Enums\ticketStatus;
use App\Models\Discount\DiscountMilitary;
use App\Models\Discount\DiscountSeniors;
use App\Models\Discount\DiscountStudent;
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

            $amount = self::checkDiscount($request->discountType , $ticket);
        self::validation($request);
        try {
            self::processPayment();
            self::store($request,$ticket,$amount);
            return redirect()->route('myCart')->with('success', 'purchased Ticket Is Successful using Sadad');
        }  catch (\Exception $e) {
            dd($e->getMessage());
        }

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

    public static function store($request,$ticket,$amount)
    {

        $ticket->update([
            'ticketStatus' => ticketStatus::USED,
        ]);

        return self::create([
            'name' => $ticket->user->name,
            'amount' => $amount,
            'paymentDate' => now(),
            'paymentType' => 'Sdad',
            'ticketId' => $ticket->id,
        ]);
    }

    public static function checkDiscount($request,$ticket)
    {
        $discountHandlers = [
            'seniors' => DiscountSeniors::class,
            'students' => DiscountStudent::class,
            'military' => DiscountMilitary::class,
        ];

        if (isset($discountHandlers[$request])) {
            $handler = $discountHandlers[$request];
            return $handler::makeDiscount($ticket->event->price);
        }

        return $ticket->event->price;
    }
}
