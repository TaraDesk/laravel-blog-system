<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        $validation = $request->validate([
            'name' => ['required', 'min:4'],
            'username' => ['required', 'unique:users,username', 'alpha_dash'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create($validation);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/home');
    }
}
