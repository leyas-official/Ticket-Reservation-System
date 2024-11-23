<?php

namespace App\Models\Payment;
use App\Enums\paymentStatus;
use App\Enums\ticketStatus;
use App\Models\Discount\DiscountMilitary;
use App\Models\Discount\DiscountSeniors;
use App\Models\Discount\DiscountStudent;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules\Enum;
use phpDocumentor\Reflection\Types\True_;


class Sadad extends Model implements Payment
{
    protected $table = 'payments';

    protected $fillable = [
        'name',
        'amount',
        'paymentType',
        'paymentDate',
        'ticketId',
        'status',
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
        $discountType = $request->discountType;
        $amount = self::checkDiscount($discountType, $ticket);
        self::validation($request);
        try {
            if(self::processPayment()){
                self::store($request,$ticket,$amount);
                return true;
            } else {
                return false;
            }
        }  catch (\Exception $e){
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
        try {
            $row = self::create([
                'name' => $ticket->user->name,
                'amount' => $amount,
                'paymentDate' => now(),
                'paymentType' => 'Sadad',
                'status' => paymentStatus::PAID,
            ]);

            $ticket->update([
                'ticketStatus' => ticketStatus::ACTIVE,
                'payment_id' => $row->id,
            ]);

        }catch (\Illuminate\Database\QueryException $e) {
            // This will catch database-related exceptions
            dd(response()->json([
                'error' => 'Database error occurred.',
                'message' => $e->getMessage(),
            ], 500)) ; // Return a 500 Internal Server Error with the message
        } catch (\Exception $e) {
            // This will catch other general exceptions
            dd(response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage(),
            ], 500));
        }
    }

    public static function checkDiscount($discountType,$ticket)
    {
        $discountHandlers = [
            'seniors' => DiscountSeniors::class,
            'students' => DiscountStudent::class,
            'military' => DiscountMilitary::class,
        ];

        if (isset($discountHandlers[$discountType])) {
            $handler = new $discountHandlers[$discountType];
            return $handler->makeDiscount($ticket->event->price);
        }

        return $ticket->event->price;
    }
}
