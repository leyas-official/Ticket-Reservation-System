<?php

namespace App\Models\Event;

use App\Models\Ticket\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    //fields
    protected $fillable = [
        'name',
        'date',
        'time',
        'price',
        'description',
        'numberOfTicket',
        'locationId',
        'type',
        'endDate',

    ];

    //main method responsible for storing and adding movie instances into the database
    public static function addEvent(Request $request) {
        $event = self::validation($request);
        try {
            self::createEvent($event);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    //main method responsible for updating movie instances into the database
    public static function editEvent($request, $data) {
        $validatedData = self::validation($request);
        try {
            self::updateEvent($validatedData, $data);
        } catch (\Exception $e) {
            \Log::error('Failed to add event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add the event. Please try again.');
        }
    }

    //retrieves all events for view
    public function getAllEvents()
    {
        return Event::query()
        ->where('name','like','%'.request()->input('search').'%')
        ->get();
    }

    public function getEventsForMonth($startOfMonth, $endOfMonth)
    {
        return Event::whereBetween('date', [$startOfMonth, $endOfMonth])->get();
    }

    public function getAllEndedEvents(){
        $today = Carbon::today(); // Get today's date
        return Event::where('endDate', '<', $today)->get();
    }




    // database relationships
    public function rate()
    {
        return $this->hasMany(Rate::class, 'eventId');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function movies()
    {
        return $this->hasone(Movies::class);
    }

    public function sports()
    {
        return $this->hasone(Sports::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class , 'eventId');
    }

}
