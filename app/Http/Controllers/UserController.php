<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarImgRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\Interfaces\SaveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $images;

    public function __construct(SaveFile $images)
    {
        $this->images = $images;

    }

    public function index()
    {

        $userGroup = Auth::user()->group()->get();

        $post = Group::with(['posts' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->whereHas('posts', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('pages.profile',
            ['user' => Auth::user(),
                'userGroup' => $userGroup,
                'postsCreator' => $post
            ]
        );
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(AvatarImgRequest $request, User $user)
    {
       $this->images->save($user, $request->img);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
