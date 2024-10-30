<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event\Event;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/events/index', function ()  {
    return view('events.index', [
        'events' => Event::getAllEvents()
    ]);
})->name('events');

Route::get('/events/Booking/{event}', function ()  {
    return view('events.booking');
})->name('booking');

Route::get('/myTickets', function () {
    return view('myTickets');
});
