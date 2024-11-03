<?php

namespace App\Models\People;

use Illuminate\Http\Request;
use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Admin extends Person
{
    protected $table = 'customers';


    // Add Event Method
    public static function addEvent(Request $request) {

        $event = Event::validation($request);

        try {

            Event::createEvent($event);

            return redirect()->route('admin.events')->with('success', 'Add Event Successful');
            
        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to add event. Please try again later.');
        }
    }



    public static function editEvent($eventId , Request $request) {
        $data = Event::validation($request);

        try {

            $event = Event::where('id', $eventId)->get()->first();

            Event::updateEvent($event , $data);

            return redirect()->route('admin.events')->with('success', 'Update Event Successful');
        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to add event. Please try again later.');
        }

    }

    public static function deleteEvent($eventId) {

        try {

            $event = Event::where('id', $eventId)->get()->first();

            $event->delete();

            return redirect()->route('admin.events')->with('success', 'Delete Event Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to add event. Please try again later.');
        }

    }


}
