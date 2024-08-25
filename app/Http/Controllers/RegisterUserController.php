<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        // ---------validate
        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'max:254'],
            // this will add a password_confirmation field to the request
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        // ---------create the user
        $user = User::create($attributes);
        // User::create([
        //     'first_name' => request('first_name'),
        //     'last_name' => request('last_name'),
        //     'email' => request('email'),
        //     'password' => bcrypt(request('password')),
        // ])
        // ---------login
        Auth::login($user);

        // ----------redirect
        return redirect('/jobs');
    }
}
