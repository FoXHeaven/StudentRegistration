<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','confirmed', Password::defaults()],
            'role' => ['required','in:student,teacher'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $user->role === 'teacher' 
            ? redirect()->route('teacher.dashboard') 
            : redirect()->route('student.dashboard');
    }
}
