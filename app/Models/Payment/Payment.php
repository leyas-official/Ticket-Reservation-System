<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment\DebtCard;
use App\Models\Payment\idfali;
use App\Models\Payment\MobyCash;
use App\Models\Payment\Sadad;

class Payment extends Model
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
