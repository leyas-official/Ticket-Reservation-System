<?php

namespace App\Models\Event;

use App\Models\People\Customer;
use Illuminate\Database\Eloquent\Model;
use carbon\carbon;
use Illuminate\Support\Facades\Auth;

class Rate extends Model
{
    protected $table = 'Ratings';
    protected $fillable = [
        'NumberOfStars',
        'userID',
        'eventID',
        'description',
    ];

    public function hundleStoreRateProcedure($request, $event){
        $validatedData = self::validate($request);
        self::storeRate($validatedData, $event);
    }

    public function storeRate($validatedData, $event){
        self::create([
            'NumberOfStars' => $validatedData['NumberOfStars'],
            'userID' => Auth::user()->id,
            'eventID' => $event->id,
            'description' => $validatedData['description'],
        ]);
    }


    public function validate($request){
        return $request->validate([
            'NumberOfStars' => 'required|integer|between:1,5',
            'description' => 'required|string',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'userId');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
