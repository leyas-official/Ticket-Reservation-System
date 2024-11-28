<?php

namespace App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'capacity',
    ];

    // return all location names
    public function getAllLocations() {
        return Location::all();
    }

    // validates data and returns it to form page if data is invalid
    public static function validation($request) {
        return $request->validate([
            'name' => 'required|string|min:1|max:255',
            'capacity' => 'required|integer|min:1|max:500',
            'address' => 'required|string|max:255',
        ]);
    }

    // creates and saves an instance of Location into the database
    public static function createLocation($location) {
        return self::create([
            'name' => $location['name'],
            'capacity' => $location['capacity'],
            'address' => $location['address'],
        ]);
    }

    // updates an instance of Location in the database
    public static function updateLocation($location , $data) {
        $location->update($data);
        return $location;
    }
    // return all location name by ID
    //    public static function getLocationById($id) {
    //
    //    }


    // database relationships
    public function events(){
        return $this->hasMany(Event::class);
    }
}
