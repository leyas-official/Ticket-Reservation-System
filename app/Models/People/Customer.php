<?php

namespace App\Models\People;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Event\Event;
use App\Models\Event\Rate;
use App\Models\Ticket\Ticket;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class Customer extends Person
{
    protected $table = 'customers';

    public  function getCustomers()
    {
        return self::where('role', 'U')->get();
    }

    //inserts new customer to the customers table
    public static function createUser($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'Role' => 'U',
        ]);
    }

    public function getCustomersForMonth($startOfMonth, $endOfMonth)
    {
        return Customer::whereHas('tickets', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereHas('event', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
            });
        })->get();
    }

    public function addToCart(Event $event ,Customer $customer) {
        $ticket = new Ticket();
        $ticket->createTicket($event,$customer);
        return redirect()->route('events')->with('success', 'Add Cart Successful');
    }

    public function rate()
    {
        return $this->hasone(Rate::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'userId');
    }

    public function events()
    {
        return $this->hasManyThrough(Event::class, Ticket::class, 'userId', 'id', 'id', 'eventId');
    }
}
