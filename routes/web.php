<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event\Event;
use App\Models\User;
use App\Models\Ticket\Ticket;
use App\Models\Payment\Payment;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/register', function () {
    return view('auth.signUp');
})->name('register'); // Go To Register Page

Route::post('/signUp', [User::class , 'signUp'])->name('signUp');

Route::post('/signIn', [User::class , 'signIn'])->name('signIn');



Route::get('/events/index', function ()  {
    return view('events.index', [
        'events' => Event::getAllEvents()
    ]);
})->name('events');


Route::post('events', [Ticket::class, 'booking'])->name('booking');

Route::get('/events/booking/{event}', function (Event $event) {
    return view('events.booking', ['event' => $event]);
})->name('book');



Route::get('/myTickets', function () {
    return view('myTickets');
});
