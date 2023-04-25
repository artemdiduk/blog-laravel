<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Post;
use App\Http\Requests\CreatorRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class GroupController extends Controller
{
    public function show(Group $group)
    {
        $posts = $group->posts()->get()->sortByDesc(function ($post) {
            return count($post->likedUsers()->get());
        });
        return view('pages.group.group', ["group" => $group, "posts" => $posts]);
    }
    public function create(Group $group, CreatorRequest $request)
    {
        $slug = Str::slug($request->group);
        $name = $request->group;
        $group::create(['name' => $name, 'slag' => $slug, 'user_id' =>  Auth::id()]);
        return redirect("group/$slug")->with('status', 'Group created!');
    }
}
