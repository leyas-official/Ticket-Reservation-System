<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{

    protected $fillable = [
        'name'
    ];

    //returns all event types from event types table

    public  function getAllTypes() {
        return self::withCount(['events' => function ($query) {
            $query->whereColumn('event_types.id', 'events.eventTypeId');
        }])->get();
    }

    public static function validation($request)
    {
        return $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s.-]+$/|min:3|max:100',
        ]);
    }

    public static function createEventType($eventType){
        return self::create([
            'name' => $eventType['name'],
        ]);
    }

    public static function updateEventType($eventType , $data){
        $eventType->update($data);
        return $eventType;
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'eventTypeId');
    }
}
