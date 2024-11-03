<?php

namespace App\Models\Payment;

class DebtCard extends Payment
{
    public function processPayment(){
        return True;
    }
}
