<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'capacity',
    ];

    // return all location names
    public static function getAllLocations() {
        return Location::all();
    }

    // return all location name by ID
    public static function getLocationById($id) {

    }


    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
