<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;

class Rate extends Model
{
    protected $table = 'Ratings';
    protected $fillable = [
        'NumberOfStars',
        'userID',
        'eventID',
        'description',
    ];

    public function storeRate($request){

    }

    //returns all ratings from this database
    public function getAllRatings($endedEvents){

    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
