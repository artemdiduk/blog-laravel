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
            'pages.admin-homepage',
            [
                'postCount' => $post->count(),
                'contents' => $group->with('posts')->get()
            ]
        );
    }

    public function delateGroup(Group $groupDelate)
    {
        $groupDelate->delete();
        return redirect('/admin');
    }

    public function updateGroupCreate(Group $groupUpdateForm)
    {
        return view(
            'pages.admin-group-update',
            [
                "group" => $groupUpdateForm,
            ]
        );
    }

    public function updateGroup(Group $groupUpdate, CreatorRequest $request, Post $posts)
    {
        $slug = Str::slug($request->group);
        $name = $request->group;
        $posts->where('group_id', $groupUpdate->id)->update(['slag_group'=>  $slug]);
        $groupUpdate->update(['name' => $name, 'slag' => $slug]);
        return redirect("/group/$groupUpdate->slag");
    }

    public function users(User $users)
    {
        $users = $users->with('group', 'posts')->get();

        $group = new Group();

        return view('pages.admin-users', [
            'users' => $users,
            'groupAll' => $group->get(),
        ]);
    }



    public  function  showUser(User $user) {

        $userGroup = $user->group()->get();
        $post = Group::with(['posts' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->whereHas('posts', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('pages.profile',
            ['user' => $user,
                'userGroup' => $userGroup,
                'postsCreator' => $post
            ]
        );
    }





}
