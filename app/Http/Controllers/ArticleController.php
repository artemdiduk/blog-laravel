<?php

namespace App\Http\Controllers;

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
            'description' => $requests->description,
            'group_id' => $group->id,
            'user_id' => Auth::id(),
        ]);
        $this->images->save($post, $requests->file('imag'));
        return redirect("$group->slag/$post->slag")->with('status', 'Post created!');
    }

    public function show(Group $group, Post $post, Request $request, User $user)
    {
        $post = $post->where(['slag' => Str::afterLast($request->path(), '/')])->first();
        if ($post) {
            return view('pages.article-show', [
                'postName' => $post->name,
                'postSlag' => $post->slag,
                'postId' => $post->id,
                "postDescription" => $post->description,
                'postImg' => $post->img,
                'author' => $user->where(['id' => $post->user_id])->first(),
                'groups' => $group->all(),
                'thisGroup' => $group->where(['id' => $post->group_id])->first(),
            ]);
        }
    }

    public function updateStore(Request $request, Post $post, Group $group)
    {
        $post = $post->where(['slag' => $request->query('article')])->first();
        if ($post && $post->user_id == Auth::id()) {
            return view('pages.article-update', [
                'postName' => $post->name,
                'postId' => $post->id,
                'postSlag' => $post->slag,
                "postDescription" => $post->description,
                'postImg' => $post->img,
                'groups' => $group->all(),
                'thisGroup' => $group->where(['id' => $post->group_id])->first(),
            ]);
        }
        return abort(404);
    }
    public function update(UpdateRequestArticle $request, Post $post, Group $group, RequestInputCahange $update)
    {

        if ($postSearch = ($post->where(['id' => $request->post_id])->first())) {
            $groupSearch = $group->where(['slag' => $request->group])->first();
            $update->updateRequestInputText($postSearch, $request->name, ['name' => $request->name, 'slag' => Str::slug($request->name)]);
            $update->updateRequestInputText($postSearch, $request->description, ['description' => $request->description]);
            if ($request->group) {
                $update->updateRequestInputText($postSearch, $request->group, ['group_id' => $groupSearch->id]);
            }
            if ($request->img) {
                $this->images->save($postSearch, $request->img);
            }
            return $update->toArticle($group->where(['id' => $postSearch->group_id])->first(), $post->where(['id' => $request->post_id])->first());
        }
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
