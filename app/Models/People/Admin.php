<?php

namespace App\Models\People;

use Illuminate\Http\Request;
use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Admin extends Person
{
    protected $table = 'customers';


    public static function addEvent(Request $request) {
        $event = Event::validation($request);
        Event::createEvent($event);
        return redirect()->route('admin.events')->with('success', 'Add Event Successful');
    }

    public static function editEvent($eventId , Request $request) {
        $data = Event::validation($request);
        $event = Event::where('id', $eventId)->get()->first();
        Event::updateEvent($event , $data);
        return redirect()->route('admin.events')->with('success', 'Update Event Successful');
    }

    public static function deleteEvent($eventId) {
        $event = Event::where('id', $eventId)->get()->first();
        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Delete Event Successful');
    }


}
