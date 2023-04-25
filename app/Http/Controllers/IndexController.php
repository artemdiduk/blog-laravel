<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class IndexController extends Controller
{
    public function __invoke() {
       
        return view('pages.homepage', ['groups' => Group::all()]);
    }
  
}
