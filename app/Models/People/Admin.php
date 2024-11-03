<?php

namespace App\Models\People;

use Illuminate\Http\Request;
use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Admin extends Person
{
    protected $table = 'customers';


    // admins Adds Event method
    public static function addEvent(Request $request) {

        $event = Event::validation($request);

        try {

            Event::createEvent($event);

            return redirect()->route('admin.events')->with('success', 'Event has been added Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }


    // admins updates Event method
    public static function editEvent($eventId , Request $request) {
        $data = Event::validation($request);

        try {

            $event = Event::where('id', $eventId)->get()->first();

            Event::updateEvent($event , $data);

            return redirect()->route('admin.events')->with('success', 'Update Event Successful');
        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to update the event. Please try again.');
        }

    }

    // admins deletes Event method
    public static function deleteEvent($eventId) {

        try {

            $event = Event::where('id', $eventId)->get()->first();

            $event->delete();

            return redirect()->route('admin.events')->with('success', 'Delete Event Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to add event: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Delete event. Please try again.');
        }

    }


}
