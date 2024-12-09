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

class Idfali extends Payment
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
    public function validation($request)
    {
        $validator = \Validator::make($request->all(), [
            'cardNumber' => 'required|numeric',
            'nationalId' => 'required|numeric|starts_with:1,2|digits:10',
            'discountType' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return $validator->validated(); // Return validated data if successful
    }
}
