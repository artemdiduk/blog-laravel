<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\CreatorRequestArticle;
use App\Http\Requests\UpdateRequestArticle;
use App\Models\Post;
use  App\Services\Interfaces\SaveFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Actions\RequestInputCahange;

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
            'slag' => Str::slug($requests->name),
            'description' => "$requests->description",
            'group_id' => $group->id,
            'user_id' => Auth::id(),
            'slag_group' => $group->slag,
        ]);
        $this->images->save($post, $requests->file('imag'));
        return redirect("$group->slag/$post->slag")->with('status', 'Post created!');
    }

    public function show(Group $group, Post $post, Request $request, User $user, Comment $comments)
    {
        $post = $post->where(['slag' => Str::afterLast($request->path(), '/')])->first();

        $comments = $user->with(['comments' => function($query) use ($post) {
            $query->where(['post_id' => $post->id, 'active' => 1])->get();
        }])->whereHas('comments')->get();
        $comments = $comments->filter(function ($user) {
            if($user->comments->isNotEmpty()) {
                $comments = $user;
                return $comments;
            }
        });

        if ($post) {
            return view('pages.article-show', [
                'postName' => $post->name,
                'postSlag' => $post->slag,
                'postId' => $post->id,
                "postDescription" => $post->description,
                'postImg' => $post->img,
                'author' => $user->where(['id' => $post->user_id])->first(),
                'groups' => $group->all(),
                'post' => $post,
                'thisGroup' => $group->where(['id' => $post->group_id])->first(),
                'comments' => $comments,
            ]);
        }
    }

    public function updateStore(Request $request, Post $post, Group $group)
    {
        $post = $post->where(['id' => $request->query('post_id')])->first();

        return view('pages.article-update', [
            'postName' => $post->name,
            'postId' => $post->id,
            'postSlag' => $post->slag,
            "postDescription" => $post->description,
            'postImg' => $post->img,
            'groups' => $group->all(),
            'thisGroup' => $group->where(['id' => $post->group_id])->first(),
            'post' => $post
        ]);

    }

    public function update(UpdateRequestArticle $request, Post $post, Group $group)
    {

        if ($request->name) {
            $slag = Str::slug($request->name);
            $post->update(['name' => $request->name, 'slag' => $slag ]);
            return redirect("$post->slag_group/$slag ")->with('status', 'Post created!');
        }
        if ($request->description) {
            $post->update(['description' => $request->description]);
        }
        if ($request->group) {
            $id = (int)$request->group;
            $groupSlag = $group->where(['id' => $id])->first('slag');
            $post->update(['group_id' => $id, 'slag_group' => $groupSlag->slag]);
            return redirect("$groupSlag->slag/$post->slag")->with('status', 'Post created!');
        }
        if ($request->img) {
            $this->images->save($post, $request->img);
        }
        return redirect("$post->slag_group/$post->slag")->with('status', 'Post created!');

    }

    public function delate(Post $post, Request $request, Group $group)
    {

        if ($postSearch = ($post->where(['id' => $request->input("post_id")])->first())) {
            $group = $group->where(['id' => $postSearch->group_id])->first();
            $postSearch->delete();
            return redirect("group/$group->slag")->with('status', 'Post delate!');

        }
    }
}
