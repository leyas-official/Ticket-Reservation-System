<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{

    protected $fillable = [
        'name'
    ];

    public static function getAllTypes() {
        return EventType::all();
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
