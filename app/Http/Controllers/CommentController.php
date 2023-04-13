<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\Interfaces\SaveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $img;

    public function __construct(SaveFile $img)
    {
        $this->img = $img;
    }

    public function index(Comment $comment, User $users)
    {

        $posts = Post::with(['comments' => function ($query) {
            $query->where("active", 0);
        }])->whereHas('comments', function ($query) {
            $query->where("active", 0);
        })->get();

        return view('pages.admin-comment', [
            'users' => $users,
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function commentsJson(User $user)
    {
        $user = $user->comments()->where(['active' => 0])->get();
        return response()->json($user->count());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, User $user, Post $post, Comment $comment)
    {

        $comment = $comment->create([
            'description' => Str::of($request->text)->trim(),
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
        $this->img->save($comment, $request->img);
        return response()->json(['success' => 'Комментарий передан на утверждение админа']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $comments = Comment::where(['post_id' => $postId, 'active' => 0])->get();
           if($comments->count() == 0) {
               return response()->json(['post_id' => $postId]);
           }
        return response()->json([true]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['success' => 'Удаление успешно']);
    }

    public function approved(CommentRequest $request, Comment $comment)
    {

        $comment->update(['description' => $request->text, 'active' => 1]);
        $this->img->save($comment, $request->img);
        return response()->json(['success' => 'успешно']);
    }
}
