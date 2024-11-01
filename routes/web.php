<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event\Event;
use App\Models\Event\Location;
use App\Models\Event\EventType;
use App\Models\People\Customer;
use App\Models\Ticket\Ticket;
use App\Models\Payment\Payment;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/register', function () {
    return view('auth.signUp');
})->name('register'); // Go To Register Page

Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // Go To Register Page

Route::post('/cancelReservation', [Ticket::class , 'cancelReservation'])->name('ticketCancel');

Route::post('/signUp', [Customer::class , 'signUp'])->name('signUp');

Route::post('/signIn', [Customer::class , 'signIn'])->name('signIn');

Route::get('/signOut', [Customer::class, 'signOut'])->name('signOut');

Route::get('/events/index', function ()  {
    return view('events.index', [
        'events' => Event::getAllEvents()
    ]);
})->name('events');

Route::get('/myTickets', function ()  {
    return view('myTickets', [
        'userTickets' => Ticket::getAllUserTickets(Customer::getId())
    ]);
})->name('userTickets');

Route::get('/cancelReservation/{eventTicket}', function ($eventTicket) {
    return view('cancelReservation', ['ticket' => Ticket::getTicketByID($eventTicket)]);
})->name('cancelReservation');

Route::post('events', [Ticket::class, 'booking'])->name('booking');

Route::get('/events/booking/{event}', function (Event $event) {
    return view('events.booking', ['event' => $event]);
})->name('book');

Route::post('/events/booking', [Ticket::class , 'addTicket'])->name('addTicket');

// Admin Pages
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/Admin/dashboard', function () {
        return view('admin.dashboard', [
            'events' => Event::getAllEvents(),
            'tickets' => Ticket::getAllTickets(),
            'customers' => Customer::getCustomers(),
        ]);
    })->name('dashboard');

    // Events
    Route::get('/Admin/events', function () {
        return view('admin.events.index', [
            'events' => Event::getAllEvents(),
        ]);
    })->name('admin.events');

    Route::get('/Admin/events/create', function () {
        return view('admin.events.create' , ['locations' => Location::getAllLocations() , 'types' => EventType::getAllTypes() ]);
    })->name('admin.events.create');
});

