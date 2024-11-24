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
        'eventId',
    ];

    public static function addEventMovies(Request $request) {

        $event = self::validation($request);

        try {
            self::createEvent($event);
//            return redirect()->route('admin.events')->with('success', 'Event has been added Successful');
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    public static function editEventMovies($request) {

        $event = self::validation($request);
        try {
            self::updateEvent($event);
//            return redirect()->route('admin.events')->with('success', 'Event has been added Successful');
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    public static function updateEvent($request) {
        try {
            $movie = Event::update([
                'name' => $request['name'],
                'description' => $request['description'],
                'date' => $request['date'],
                'time' => $request['time'],
                'locationId' => $request['location'],
                'type' => $request['type'],
                'price' => $request['price'],
                'numberOfTicket' => $request['numberOfTicket'],
            ]);

            return $model->update([
                'theaterNumber' => $request['theaterNumber'],
                'director' => $request['director'],
                'genre' => $request['director'],
                'length' => $request['length'],
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



    public static function validation($request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|integer|exists:locations,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'numberOfTicket' => 'required|integer|min:1',
            'theaterNumber' => 'required|numeric',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'length' => 'required'
        ]);
    }

    public static function createEvent($event)
    {


            $movie = Event::create([
                'name' => $event['name'],
                'description' => $event['description'],
                'date' => $event['date'],
                'time' => $event['time'],
                'locationId' => $event['location'],
                'type' => $event['type'],
                'price' => $event['price'],
                'numberOfTicket' => $event['numberOfTicket'],
            ]);



        try {

            return self::create([
                'eventId' => $movie->id,
                'theaterNumber' => $event['theaterNumber'],
                'director' => $event['director'],
                'genre' => $event['director'],
                'length' => $event['length'],
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

    public function getTypeDataById($id){
        return self::where('eventId', $id)->first();
    }

    public function events(){
        return $this->belongsTo(Event::class, 'eventId');
    }
}
