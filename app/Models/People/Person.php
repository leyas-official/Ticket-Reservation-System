<?php

namespace App\Models\People;

use Illuminate\Auth\Authenticatable; // Import this trait
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

abstract class Person extends Model implements AuthenticatableContract
{
    use Authenticatable; // Use the Authenticatable trait

    protected $fillable = [
        'name',
        'email',
        'password',
        'Role'
    ];

    // Sign-in method
    public static function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Role check
            if (Auth::user()->Role === 'A') {
                return redirect()->route('dashboard')->with('success', 'Welcome Admin!');
            } else  {
                return redirect()->route('events')->with('success', 'Login Successful');
            }
        } else {
            return back()->withErrors([
                'email' => 'The password or email is incorrect, please try again!',
                'password' => 'The password or email is incorrect, please try again!',
            ])->onlyInput('password');
        }
    }

    // Sign-up method
    public static function signUp(Request $request)
    {
        $validatedData = self::validation($request);
        $user = self::createUser($validatedData);
        Auth::login($user);
        return redirect()->route('admin.events')->with('success', 'Signup Successful');
    }

    // Validation method
    public static function validation(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email', // Updated to reflect the customer table
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    // Sign-out method
    public function signOut(Request $request)
    {
        Auth::logout();
        return redirect()->to(url('/'));
    }

    // User creation method
    public static function createUser($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'Role' => 'U',
        ]);
    }

    public static function getID(){
        if(Auth::check()) {
            return auth::id();
        }

        return null;
    }
}
