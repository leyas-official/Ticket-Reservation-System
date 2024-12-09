<?php

namespace App\Models\Event;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //fields
    protected $fillable = [
        'name',
        'date',
        'time',
        'price',
        'description',
        'numberOfTicket',
        'locationId',
        'type',
        'endDate'
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
            'endDate' => 'required|date|after:today',
        ]);
    }



    // database relationships
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

    public function tickets()
    {
        return $this->hasMany(Ticket::class , 'eventId');
    }

}
