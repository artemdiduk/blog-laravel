<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Http\Requests\CreatorRequest;
use Illuminate\Support\Str;
use App\Models\User;

class AdminController extends Controller
{


    public function show(Post $post, Group $group)
    {
 
        return view(
            'pages.admin.admin-homepage',
            [
                'postCount' => $post->count(),
                'contents' => $group->with('posts')->get()
            ]
        );
    }

    public function delateGroup(Group $group)
    {   
        $group->delete();
        return redirect('/admin');
    }

    public function updateGroupStore(Group $group)
    {
        return view(
            'pages.admin.admin-group-update',
            [
                "group" => $group,
            ]
        );
    }

    public function updateGroup(Group $group, CreatorRequest $request, Post $posts)
    {
        $slag = Str::slug($request->group);
        $name = $request->group;
        $group->update(['name' => $name, 'slag' => $slag]);
        return redirect("/group/$slag");
    }

    public function users(User $users, Group $groups)
    {
        $users = $users->with('group', 'posts')->get();
        return view('pages.admin.admin-users', [
            'users' => $users,
            'group' => $groups
        ]);
    }


    public  function  showUser(User $user) {
        $userGroup = $user->group()->get();
        $post = Group::with(['posts' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->whereHas('posts', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('pages.profile.profile',
            ['user' => $user,
                'userGroup' => $userGroup,
                'postsCreator' => $post
            ]
        );
    }





}
