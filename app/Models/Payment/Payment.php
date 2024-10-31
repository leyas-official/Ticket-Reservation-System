<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'paymentDate',
    ];

    public function getAllPayment()
    {
        return Payment::all();
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
