<?php

namespace App\Models\Payment;

class DebtCard implements Payment
{
    protected $fillable = [
        'name',
        'paymentMethod',
        'amount',
        'paymentDate',
    ];

    public function getAllPayment()
    {
        return Payment::all();
    }

    public function processPayment(){
        return True;
    }

    public function processRefund(){
        return True;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
