<?php

namespace App\Models\People;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class Customer extends Person
{
    protected $table = 'customers';

    public static function getCustomers()
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

}
