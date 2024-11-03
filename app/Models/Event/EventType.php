<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{

    protected $fillable = [
        'name'
    ];

    //returns all event types from event types table
    public static function getAllTypes() {
        return EventType::all();
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
