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

    public function read(Group $group)
    {

        return view('pages.article.article-create', [
            "groups" => Group::all(),
            "thisGroup" => $group,
        ]);
    }

    public function create(Post $post, CreatorRequestArticle $requests, Group $group)
    {
        $group = $group->find($requests->group);
        $post = $post->create([
            'name' => $requests->name,
            'slag' => Str::slug($requests->name),
            'description' => "$requests->description",
            'group_id' => $group->id,
            'user_id' => Auth::id(),
        ]);
        $this->images->save($post, $requests->file('imag'));
        return redirect("$group->slag/$post->slag")->with('status', 'Post created!');
    }

    public function show(Group $group, Post $post, User $user, Comment $comments)
    {
        $comments = $user->with(['comments' => function ($query) use ($post) {
            $query->where(['post_id' => $post->id, 'active' => 1])->get();
        }])->whereHas('comments')->get();

        $comments = $comments->filter(function ($user) {
            if ($user->comments->isNotEmpty()) {
                $comments = $user;
                return $comments;
            }
        });

        return view('pages.article.article-show', [
            'author' => $user->where(['id' => $post->user_id])->first(),
            'post' => $post,
            'group' => $group,
            'comments' => $comments,
        ]);
    }

    public function updateStore(Post $post, Group $group)
    {
        return view('pages.article.article-update', [
            'post' => $post,
            'groups' => $group->all(),
            'thisGroup' => $group->find($post->group_id),
        ]);
    }

    public function update(UpdateRequestArticle $request, Post $post, Group $group)
    {
        $group = $group->find($post->group_id);
        if ($request->name) {
            $slag = Str::slug($request->name);
            $post->update(['name' => $request->name, 'slag' => $slag]);
        }
        if ($request->description) {
            $post->update(['description' => $request->description]);
        }
        if ($request->group) {
            $group = $group->find((int)$request->group);
            $post->update(['group_id' => $group->id]);
        }
        if ($request->img) {
            $this->images->save($post, $request->img);
        }
        return redirect("$group->slag/$post->slag")->with('status', 'Post update!');
    }

    public function delate(Post $post, Request $request, Group $group)
    {
        $group = $group->find($post->group_id);
        $post->delete();
        return redirect("group/$group->slag")->with('status', 'Post delate!');
    }

    public function liked(Post $post, User $user)
    {
        $data = $post->likedUsers()->toggle($user);
        return response()->json($data['attached']);
    }
}
