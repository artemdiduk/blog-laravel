<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Http\Requests\CreatorRequest;
use Illuminate\Support\Str;

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

    public function delateGroup(Group $groupDelate) {
        $groupDelate->delete();
        return redirect('/admin');
    }

    public function updateGroupCreate(Group $groupUpdateForm) {
        return view(
            'pages.admin-group-update',
            [
                "group" => $groupUpdateForm,
            ]
        );
    }

    public function updateGroup(Group $groupUpdate, CreatorRequest $request) {
        $slug = Str::slug($request->group);
        $name = $request->group;
        $groupUpdate->update(['name' => $name, 'slag' => $slug]);
        return redirect("/group/$groupUpdate->slag");
    }
}
