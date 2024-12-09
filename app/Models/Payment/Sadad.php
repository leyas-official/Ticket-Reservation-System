<?php

namespace App\Models\Payment;
use App\Enums\paymentStatus;
use App\Enums\ticketStatus;
use App\Models\Discount\DiscountMilitary;
use App\Models\Discount\DiscountSeniors;
use App\Models\Discount\DiscountStudent;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Enum;
use phpDocumentor\Reflection\Types\True_;
use Illuminate\Http\Request;


class Sadad extends Payment
{
    //fake methods
    public function processPayment()
    {
        return True;
    }

    public function processRefund()
    {
        return True;
    }

    // validates data and returns it to form page if data is invalid
    public function validation(Request $request){
        $validator = \Validator::make($request->all(), [
            'fullName' => 'required|min:3|max:50',
            'phoneNumber' => 'required|numeric',
            'cardExpiration' => 'required|date|after:today',
            'discountType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $validator->validated(); // Return validated data if successful
    }




}
