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

    //main method responsible for storing and adding movie instances into the database
    public static function addEventMovies(Request $request) {
        $event = self::validation($request);
        try {
            self::createEvent($event);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    //main method responsible for updating movie instances into the database
    public static function editEventMovies($request, Movies $data) {
        $validatedData = self::validation($request);
        try {
            self::updateEvent($validatedData, $data);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    //updates the saved data in the database
    public static function updateEvent($request, Movies $movie) {
        try {
            $movie->events->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'date' => $request['date'],
                'time' => $request['time'],
                'locationId' => $request['location'],
                'type' => $request['type'],
                'price' => $request['price'],
                'numberOfTicket' => $request['numberOfTicket'],
                'endDate' => $request['endDate'],
            ]);

            $movie->update([
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



    // validates data and returns it to form page if data is invalid
    public static function validation($request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date',
            'endDate' => 'required|date',
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


    // creates an instance of event and saves it into the database
    // also creates an instance of movie and saves it into the database
    // now that may sound weird but that's just how laravel works
    // it automatically creates these instances before it saves into the database
    public static function createEvent($event)
    {
        try {
            $movie = Event::create([
                'name' => $event['name'],
                'description' => $event['description'],
                'date' => $event['date'],
                'time' => $event['time'],
                'locationId' => $event['location'],
                'type' => $event['type'],
                'price' => $event['price'],
                'numberOfTicket' => $event['numberOfTicket'],
                'endDate' => $event['endDate'],
            ]);

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

    // retrieve a record by ID
    public function getTypeDataById($id){
        return self::where('eventId', $id)->first();
    }

    //database relationship
    public function events(){
        return $this->belongsTo(Event::class, 'eventId');
    }
}
