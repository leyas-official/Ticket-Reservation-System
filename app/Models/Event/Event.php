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
        'locationId',
        'eventTypeId',
    ];

    public static function getAllEvents()
    {
        return Event::query()
        ->where('name','like','%'.request()->input('search').'%')
        ->get();
    }

    public static function validation($request)
    {
        return  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|integer|exists:locations,id',
            'type' => 'required|integer|exists:event_types,id',
            'price' => 'required|numeric',
            'numberOfTicket' => 'required|integer|min:1',
        ]);
    }

    public static function createEvent($event)
    {
        return self::create([
            'name' => $event['name'],
            'description' => $event['description'],
            'date' => $event['date'],
            'time' => $event['time'],
            'locationId' => $event['location'],
            'eventTypeId' => $event['type'],
            'price' => $event['price'],
            'numberOfTicket' => $event['numberOfTicket'],
        ]);
    }

    public static function updateEvent($event , $data)
    {
        $event->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'date' => $data['date'],
            'time' => $data['time'],
            'locationId' => $data['location'],
            'eventTypeId' => $data['type'],
            'price' => $data['price'],
            'numberOfTicket' => $data['numberOfTicket'],
        ]);

        return $event;
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
