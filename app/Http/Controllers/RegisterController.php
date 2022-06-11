<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => [
                'required',
                'max:255'
            ],
            'username' => [
                'required',
                'min:3',
                'max:255',
                // 'unique:users,username'
                Rule::unique('users', 'username')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                // 'unique:users,username'
                Rule::unique('users', 'email')
            ],
            'password' => [
                'required',
                'min:8',
                'max:255'
            ]
        ]);

        $user = User::create($attributes);

        // auth()->login($user);
        Auth::login($user);

        // session()->flash('success', 'Your account has been created.');
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
