<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRegisrationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisrationController extends Controller
{
    public function show()
    {
        return view('pages.auth.regisration');
    }
    public function register(AuthRegisrationRequest $requests, User $user)
    {

        $user = $user->create(['name' => Str::lower($requests->name), 'slag' => $requests->name, 'email' =>  $requests->email, 'password' => Hash::make($requests->password)]);
        Auth::login($user);
        $requests->session()->regenerate();
        return redirect()->intended('account');
    }
}
