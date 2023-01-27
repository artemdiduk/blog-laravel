<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class IndexController extends Controller
{
    public function show() {
        return view('pages.homepage');
    }
}
