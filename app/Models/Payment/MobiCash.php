<?php

namespace App\Models\Payment;
use App\Enums\ticketStatus;
use App\Enums\paymentStatus;
use App\Models\Discount\DiscountMilitary;
use App\Models\Discount\DiscountSeniors;
use App\Models\Discount\DiscountStudent;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rules\Enum;

class MobiCash extends Payment
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
    public function validation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'phoneNumber' => 'required|numeric|digits:10|starts_with:0',
            'discountType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $validator->validated(); // Return validated data if successful
    }




}
