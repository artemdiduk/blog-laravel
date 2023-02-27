<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Post;
use App\Http\Requests\CreatorRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class GroupController extends Controller
{
    public function show($slugGroup)
    {   
        
        $group = Group::where(['slag' => $slugGroup])->first();
        if ($group) {
            $groupId = $group->id;  
            $posts = Post::with('groups')->where(['group_id' => $groupId])->get();
            return view('pages.group', ['groupName' => $group->name, 'groupSlag' => $group->slag, "posts" => $posts]);
        }
        
        
    }
    public function create(Group $group, CreatorRequest $request)
    {
        $slug = Str::slug($request->group);
        $name = $request->group;
        $group::create(['name' => $name, 'slag' => $slug, 'user_id' =>  Auth::id()]);
        return redirect("/$slug")->with('status', 'Group created!');
    }
}
