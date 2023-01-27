<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\CreatorRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class CreatorContentController extends Controller
{
    public function createGroup(Group $group, CreatorRequest $request) {
        $slug = Str::slug($request->group);
        $name = $request->group;
        $userId = Auth::id();
       dd('s');
    }
}
