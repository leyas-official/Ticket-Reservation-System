<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/myTickets', function () {
    return view('myTickets');
});
