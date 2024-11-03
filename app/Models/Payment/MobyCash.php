<?php

namespace App\Models\Payment;

class MobyCash extends Payment
{
    public function processPayment(){
        return True;
    }
}
