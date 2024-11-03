<?php

namespace App\Models\Payment;

class Sadad extends Payment
{
    //fake methods
    public function processPayment(){
        return True;
    }

    public function processRefund(){
        return True;
    }
}
