<?php

namespace App\Models\Event;

use Illuminate\Http\Request;

class Movies extends Event
{
    protected $fillable = [
        'theaterNumber',
        'director',
        'genre',
        'length',
    ];

    public static function addEventMovie(Request $request) {

        $event = self::validation($request);

        try {
            self::createEvent($event);
            return redirect()->route('admin.events')->with('success', 'Event has been added Successful');
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
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
            'theaterNumber' => 'required|string|max:3',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'length' => 'required|date_format:H:i|before:24:00'
        ]);
    }

    public static function createEvent($event)
    {
        $Uniqueinstance = new Movies();
        $eventRecord = $Uniqueinstance->createEventMain($event);

        self::create([
            'eventId' => $eventRecord->id,
            'theaterNumber' => $event['theaterNumber'],
            'director' => $event['director'],
            'genre' => $event['director'],
            'length' => $event['length'],
        ]);
    }

    public function events()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }
}
