<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class usercontroller extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:6'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        return redirect('/login')->with('message', 'Succesfully Create account');
    }
}
