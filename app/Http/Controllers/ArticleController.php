<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\CreatorRequestArticle;
use App\Models\Post;
use  App\Services\Interfaces\SaveFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\UpdateRequestArticle;
class ArticleController extends Controller
{
    protected $images;

    public function __construct(SaveFile $images)
    {
        $this->images = $images;
    }
    public function read(Group $group, Request $req)
    {

        $groups = $group->get();
        if ($req->group) {
            $groups = $group->where(['slag' => $req->group])->get();
        }

        return view('pages.article-create', [
            "groups" => $groups,
        ]);
    }

    public function create(Post $post, CreatorRequestArticle $requests, Group $group)
    {
        $group = $group->where(['slag' => $requests->group])->first();
        $post = $post->create([
            'name' => $requests->name,
            'slag' => $group->slag . '/' . Str::slug($requests->name),
            'description' => $requests->description,
            'group_id' => $group->id,
            'user_id' => Auth::id(),
        ]);
        $this->images->save($post, $requests->file('imag'));
        return redirect("$post->slag")->with('status', 'Post created!');
    }

    public function show(Group $group, Post $post, Request $request, User $user)
    {
        $post = $post->where(['slag' => $request->path()])->first();
        
        if ($post) {
            return view('pages.article-show', [
                'postName' => $post->name,
                'postSlag' => $post->slag,
                "postDescription" => $post->description,
                'postImg' => $post->img,
                'author' => $user->where(['id' => $post->user_id])->first(),
                'groups' => $group->all(),
                'thisGroup' => $group->where(['id' => $post->group_id])->first(),
            ]);
        }
    }

    public function update(UpdateRequestArticle $request, Post $post, Group $group)
    {
        dd($request);
       
    }


    
}
