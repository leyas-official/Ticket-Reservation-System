<?php

namespace App\Models\Payment;

class MobyCash implements Payment
{

    protected $fillable = [
        'name',
        'paymentMethod',
        'amount',
        'paymentDate',
    ];

    //fake methods
    public function processPayment(){
        return True;
    }

    public function processRefund(){
        return True;
    }
    public function getAllPayment()
    {
        return Payment::all();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
