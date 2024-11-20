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
        'type',
    ];

    //retrieves all events for view
    public function getAllEvents()
    {
        return Event::query()
        ->where('name','like','%'.request()->input('search').'%')
        ->get();
    }

    //data validation
    public static function validation($request)
    {
        return  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|integer|exists:locations,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'numberOfTicket' => 'required|integer|min:1',
        ]);
    }

    //inserts event data into events table
    public function createEventMain($event)
    {
        try {
                Event::create([
                'name' => $event['name'],
                'description' => $event['description'],
                'date' => $event['date'],
                'time' => $event['time'],
                'locationId' => $event['location'],
                'type' => $event['type'],
                'price' => $event['price'],
                'numberOfTicket' => $event['numberOfTicket'],
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // This will catch database-related exceptions
            dd(response()->json([
                'error' => 'Database error occurred.',
                'message' => $e->getMessage(),
            ], 500)) ; // Return a 500 Internal Server Error with the message
        } catch (\Exception $e) {
            // This will catch other general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    //updates row data in events table
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

    public function movies()
    {
        return $this->hasone(Movies::class);
    }

    public function sports()
    {
        return $this->hasone(Sports::class);
    }

    // eventTypeId Belongs To eventType
    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'eventTypeId');
    }
}
