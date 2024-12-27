<?php

namespace App\Models\People;

use App\Models\Event\EventType;
use App\Models\Event\Location;
use App\Models\Event\Movies;
use App\Models\Event\Sports;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Admin extends Person
{
    protected $table = 'customers';


    // admins Adds a new event to database
    public static function addEvent(Request $request) {

        $type = $request->type;
        $models = [
            'movies' => Movies::class,
            'sports' => Sports::class,
        ];

        if (array_key_exists($type, $models)) {
            $modelClass = $models[$type];
            $model = new $modelClass();

            $model->addEvent($request);
            return redirect()->route('admin.events')->with('success', 'Event has been added Successful');
        } else{
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    // admin edits an event instance from database
    public static function editEvent($event, Request $request) {

        $type = $request->type;
        $models = [
            'movies' => Movies::class,
            'sports' => Sports::class,
        ];

        if (array_key_exists($type, $models)) {
            $modelClass = $models[$type];
            $model = new $modelClass();
            $model = $model->getTypeDataById($event);

            $methodName = 'editEvent' . ucfirst($type);
            if (method_exists($model, $methodName)) {
                $model->$methodName($request, $model);

                return redirect()->route('admin.events')->with('success', 'Event has been Edited Successful');
            }else{
                return redirect()->back()->with('error', 'Failed to edit the event. Please try again.');
            }
        } else{
            return redirect()->back()->with('error', 'Failed to edit the event. Please try again.');
        }

    }

    // admin deletes an event instance from database
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

    // admin add a location instance from database
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

    // admin edits a location instance from database
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


    // admin deletes a location instance from database
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
}
