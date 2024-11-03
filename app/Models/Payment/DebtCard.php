<?php

namespace App\Models\Payment;

class DebtCard extends Payment
{

    //fake methods
    public function processPayment(){
        return True;
    }

    public function processRefund(){
        return True;
    }
}
