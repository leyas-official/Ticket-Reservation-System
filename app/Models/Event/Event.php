<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'date',
        'time',
        'price',
        'description',
        'numberOfTicket',
        'discount',
    ];

    public static function getAllEvents()
    {
        return Event::all();
    }


    // locationId Belongs To Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'locationId');
    }

    // eventTypeId Belongs To eventType
    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'eventTypeId');
    }

}
