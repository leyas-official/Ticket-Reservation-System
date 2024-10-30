<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $fillable = [
        'name',
        'ticketStatus',
        'buyDate',
        'price',
        'userId',
        'eventId',
        'paymentId',
    ];

    // userId Belongs To User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    // eventId Belongs To Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }

    // paymentId Belongs To Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentId');
    }
}
