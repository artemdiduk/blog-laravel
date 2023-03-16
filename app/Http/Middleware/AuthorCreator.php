<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthorCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $post = new Post();
        $post = $post->where(['id' => $request->post_id])->first();

        if ($post->user_id == Auth::id() || ( isset(Auth::user()->roles) && Auth::user()->roles->first()->slag == 'admin') ) {
            return $next($request);
        }
        return redirect('/');
    }
}
