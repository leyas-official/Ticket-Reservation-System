<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Role'
    ];


    public static function signIn(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('events')->with('success', 'login Successful');
        } else {
            return back()->withErrors([
                'email' => 'The password or email is incorrect please try again !',
                'password' => 'The password or email is incorrect please try again !',
            ])->onlyInput('password');
        }
    }


    public static function signUp(Request $request) {
        $validatedData = self::validation($request);
        $user = self::createUser($validatedData);
        Auth::login($user);
        return  redirect()->route('events')->with('success', 'signup Successful');
    }

    public  static function validation(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        return $validatedData ;
    }

    public  static function createUser($data) {
         return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'Role' => 'U',
        ]);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
