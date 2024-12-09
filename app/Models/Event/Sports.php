<?php

namespace App\Models\Event;

use Illuminate\Http\Request;

class Sports extends Event
{
    protected $table = 'sports';
    protected $fillable = [
        'stadium',
        'homeTeam',
        'awayTeam',
        'typeOfSport',
        'length',
        'eventId',
    ];


    //main method responsible for storing and adding sports instances into the database
    public static function addEventSports(Request $request) {

        $event = self::validation($request);
        try {
            self::createEvent($event);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    //main method responsible for updating sports instances into the database
    public static function editEventSports($request, Sports $data) {
        $validatedData = self::validation($request);
        try {
            self::updateEvent($validatedData, $data);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    // validates data and returns it to form page if data is invalid
    public static function validation($request)
    {
        return  $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date',
            'endDate' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|integer|exists:locations,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'numberOfTicket' => 'required|integer|min:1',
            'stadium' => 'required|string|max:255',
            'homeTeam' => 'required|string|max:255',
            'awayTeam' => 'required|string|max:255',
            'typeOfSport' => 'required|string|max:255',
        ]);
    }

    //updates the saved data in the database
    public static function updateEvent($request, Sports $data) {
        try {
            $data->events->update([
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

            $data->update([
                'stadium' => $request['stadium'],
                'homeTeam' => $request['homeTeam'],
                'awayTeam' => $request['awayTeam'],
                'typeOfSport' => $request['typeOfSport'],
                'length' => 90,
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

    // creates an instance of event and saves it into the database
    // also creates an instance of movie and saves it into the database
    // now that may sound weird but that's just how laravel works
    // it automatically creates these instances before it saves into the database
    public static function createEvent($event){
        try{
                $sport = Event::create([
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
                    'eventId' => $sport->id,
                    'stadium' => $event['stadium'],
                    'homeTeam' => $event['homeTeam'],
                    'awayTeam' => $event['awayTeam'],
                    'typeOfSport' => $event['typeOfSport'],
                    'length' => 90,
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

    // database relationship
    public function events()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }
}
