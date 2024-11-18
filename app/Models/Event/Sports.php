<?php

namespace App\Models\Event;

use Illuminate\Http\Request;

class Sports extends Event
{
    protected $fillable = [
        'stadium',
        'homeTeam',
        'awayTeam',
        'typeOfSport',
    ];

    public static function addEventSports(Request $request) {

        $event = Sports::validation($request);

        try {
            Sports::createEvent($event);
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
            'stadium' => 'required|string|max:255',
            'homeTeam' => 'required|string|max:255',
            'awayTeam' => 'required|string|max:255',
            'typeOfSport' => 'required|string|max:255',
        ]);
    }

    public static function createEvent($event)
    {
        $Uniqueinstance = new Sports();
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
