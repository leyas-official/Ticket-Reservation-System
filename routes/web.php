<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event\Event;
use App\Models\Event\Location;
use App\Models\Event\EventType;
use App\Models\People\Customer;
use App\Models\People\Admin;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Reservation;


// ? SignIn in Signup

Route::post('/signUp', [Customer::class , 'signUp'])->name('signUp');

Route::post('/signIn', [Customer::class , 'signIn'])->name('signIn');

Route::get('/signOut', [Customer::class, 'signOut'])->name('signOut');



Route::get('/register', function () {
    return view('auth.signUp');
})->name('register'); // Go To Register Page

Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // Go To Register Page

// Customer Pages
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
});



Route::get('/events/index', function ()  {
    return view('events.index', [
        'events' => Event::getAllEvents()
    ]);
})->name('events');

Route::get('/myTickets', function ()  {
    return view('myTickets', [
        'userTickets' => Ticket::getAllUserTickets(Customer::getId())
    ]);
})->name('myTickets');

Route::post('/events/booking', [Reservation::class , 'addReservation'])->name('addTicket');

Route::get('/events/booking/{event}', function (Event $event) {
    return view('events.booking', ['event' => $event]);
})->name('book');

Route::delete('/cancelReservation/{ticketId}' , [Reservation::class , 'cancelReservation'])->name('ticket.delete');

//

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


    // Add Event
    Route::get('/Admin/events/create', function () {
        return view('admin.events.create' , ['locations' => Location::getAllLocations() , 'types' => EventType::getAllTypes() ]);
    })->name('admin.events.create');

    Route::post('/Admin/events/store', [Admin::class , 'addEvent'])->name('admin.events.store');

    // Edit Event
    Route::put('/Admin/events/{event}', [Admin::class , 'editEvent'])->name('admin.events.update');

    Route::get('/Admin/events/{event}/edit', function (Event $event) {
        return view('admin.events.edit' , ['event' => $event , 'locations' => Location::getAllLocations() , 'types' => EventType::getAllTypes() ]);
    })->name('admin.events.edit');;

    // Delete Event
    Route::delete('/Admin/events/{event}' , [Admin::class , 'deleteEvent'])->name('admin.events.delete');

    // End Events

    // Tickets
    Route::get('/Admin/Tickets', function () {
        return view('admin.tickets.index', [
            'tickets' => Ticket::getAllTickets(),
        ]);
    })->name('admin.tickets');

    Route::get('/Admin/Tickets/{ticket}', function (Ticket $ticket) {
        return view('admin.tickets.show', [
            'ticket' => $ticket,
        ]);
    })->name('admin.tickets.show');
    // End Tickets

    // Customers
    Route::get('/Admin/Customers', function () {
        return view('admin.customers.index', [
            'customers' => Customer::getCustomers(),
        ]);
    })->name('admin.customers');

    Route::get('/Admin/Customers/{customer}', function (Customer $customer) {
        return view('admin.customers.show', [
            'customer' => $customer,
        ]);
    })->name('admin.customers.show');

    // Locations
    Route::get('/Admin/Locations', function () {
        return view('admin.locations.index', [
            'locations' => location::getAllLocations(),
        ]);
    })->name('admin.locations');

    Route::get('/Admin/Locations/create', function () {
        return view('admin.locations.create');
    })->name('admin.locations.create');


    Route::POST('/Admin/Locations/create', [Admin::class , 'addLocation'])->name('admin.locations.store');

    // Edit Location
    Route::get('/Admin/Locations/{location}/edit', function (Location $location) {
        return view('admin.locations.edit' , ['location' => $location]);
    })->name('admin.locations.edit');

    Route::PUT('/Admin/Locations/{location}/edit', [Admin::class , 'editLocation'])->name('admin.locations.update');

    // Delete Location
    Route::Delete('/Admin/Locations/{location}', [Admin::class , 'deleteLocation'])->name('admin.locations.delete');

    // End Location

    // Event Types
    Route::get('/Admin/EventTypes', function () {
        return view('admin.eventTypes.index', [
            'eventTypes' => EventType::getAllTypes(),
        ]);
    })->name('admin.eventTypes');

    // Create Event Type
    Route::get('/Admin/EventTypes/create', function () {
        return view('admin.eventTypes.create');
    })->name('admin.eventTypes.create');

    Route::post('/Admin/EventTypes/store', [Admin::class , 'addEventType'])->name('admin.eventTypes.store');

    // Edit Event Type
    Route::get('/Admin/EventTypes/{eventType}/edit', function (EventType $eventType) {
        return view('admin.eventTypes.edit' , ['eventType' => $eventType]);
    })->name('admin.eventTypes.edit');

    Route::put('/Admin/EventTypes/{eventType}' , [Admin::class , 'editEventType'])->name('admin.eventTypes.update');

    // Delete Event Tyoe
    Route::delete('Admin/EventTypes/{eventType}' , [Admin::class , 'deleteEventType'])->name('admin.eventTypes.delete');
});

