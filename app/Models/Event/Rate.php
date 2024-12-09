<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'Ratings';
    protected $fillable = [
        'NumberOfStars',
        'userID',
        'eventID',
        'description',
    ];

    public function store($request){

    }

    //returns all ratings from this database
    public function getAllRatings(){
        return Event::where('endDate', '<', now())->get();
    }


}
