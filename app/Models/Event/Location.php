<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name'
    ];

    public static function getAllLocations() {
        return Location::all();
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
