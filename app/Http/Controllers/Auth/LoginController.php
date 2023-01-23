<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;

class LoginController extends Controller
{
    public function authenticate(AuthRequest $request)
    {

        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            if(auth()->user()->name == 'admin') {
                return redirect()->intended('admin');
            }
            return redirect()->intended('account');
        }   

       
    }
    public function show() {
        
        return view('pages.auth.login');
    }
}
