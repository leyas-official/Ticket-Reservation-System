<?php

namespace App\Models\People;

use App\Models\Event\EventType;
use App\Models\Event\Location;
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

    // Location Methods

    // Add Location
    public static function addLocation(Request $request)
    {
        $data = Location::validation($request);
        try {

            $location = Location::createLocation($data);

            return redirect()->route('admin.locations')->with('success', 'Add Location Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to add Location: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Add Location. Please try again.');
        }
    }

    public static function editLocation($locationId ,Request $request )
    {
        $data = Location::validation($request);

        try {

            $location = Location::where('id', $locationId)->get()->first();

            Location::updateLocation($location , $data);

            return redirect()->route('admin.locations')->with('success', 'Edit Location Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to Edit Location: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Edit Location. Please try again.');
        }
    }


    public static function deleteLocation($locationId)
    {
        try {

            $location = Location::where('id', $locationId)->get()->first();

            $location->delete();

            return redirect()->route('admin.locations')->with('success', 'Delete Location Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to Delete Location: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Delete Location. Please try again.');
        }

    }

    // Event Type
    public static function addEventType(Request $request)
    {
        $data = EventType::validation($request);

        try {

            $eventType = EventType::createEventType($data);

            return redirect()->route('admin.eventTypes')->with('success', 'Add Type Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to add Type: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Add Type. Please try again.');
        }
    }

    public static function editEventType($eventTypeId,Request $request)
    {
        $data = EventType::validation($request);

        try {

            $eventType = EventType::where('id', $eventTypeId)->get()->first();

            EventType::updateEventType($eventType , $data);

            return redirect()->route('admin.eventTypes')->with('success', 'Edit Type Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to Edit Type: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Edit Type. Please try again.');
        }
    }

    public static function deleteEventType($eventTypeId) {
        try {

            $eventType = EventType::where('id', $eventTypeId)->get()->first();

            $eventType->delete();

            return redirect()->route('admin.eventTypes')->with('success', 'Delete Event Type Successful');

        } catch (\Exception $e) {

            \Log::error('Failed to Delete  Event Type: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to Delete Event Type. Please try again.');
        }
    }
}
