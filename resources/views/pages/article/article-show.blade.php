@extends('./base')
@section('title')
    {{ $post->name }}
@endsection
@section('content')
    <div class="container">
        @if (Auth::id() == $author->id)
            <div class="col-md-2">
                <a href="{{ route('article.update.form', $post) }}" class="btn btn-primary create" data-toggle="modal"
                    data-target="#exampleModal">Змінити статтю</a>
            </div>
        @endif
        @if (Auth::id() == $author->id)
            <form action="{{ route('article.delate', $post) }}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('DELETE')
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Видалити пост</button>
                    </div>
                </div>
            </form>
        @endif

        <div style="padding-top: 20px;">
            <div class="col-md-12">
                <h3 class="display-6">{{ $post->name }}</h3>
            </div>
            <div class="col-md-12 border-bottom">
                <div class="row">
                    <div class="col-12">
                        <img src="" alt="">
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
                @if ($post->img)
                    <div class="col-12">
                        <img style="width: 100%" src="/storage/img/posts/{{ $post->img }}" alt="{{ $post->name }}">
                    </div>
                @endif
            </div>

            <div class="wrapper__like">
                @if (Auth::check())
                    <form method="post">
                        @csrf
                        <div class="like__icon {{ $post->likedUsers()->find(Auth::id()) ? 'like' : '' }}">
                            <button type="submit" data-route="{{ route('article.like', [$post, Auth::user()]) }}">
                                <svg fill="#000000" height="800px" width="800px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 295.559 295.559" xml:space="preserve">
                                    <path
                                        d="M294.626,88.215c-2.388-17.766-9.337-34.209-20.099-47.555c-9.956-12.346-22.871-21.525-36.365-25.844
	c-10.026-3.201-19.906-4.824-29.374-4.824c-24.577,0-46.313,10.811-62.147,30.678c-17.638-20.154-38.392-30.355-61.812-30.357
	c-8.839,0-18.06,1.516-27.408,4.502c-13.505,4.32-26.423,13.498-36.382,25.844C10.274,54.004,3.322,70.449,0.934,88.215
	c-3.858,28.701,4.289,60.008,23.562,90.533c22.278,35.285,59.255,69.889,109.904,102.848c3.989,2.598,8.617,3.971,13.381,3.971
	c4.764,0,9.392-1.373,13.383-3.973c50.646-32.957,87.623-67.561,109.9-102.848C290.335,148.221,298.482,116.916,294.626,88.215z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <span>
                        {{ $post->likedUsers()->count() }}
                    </span>
                @else
                    <div class="like__icon">
                        <svg fill="#000000" height="800px" width="800px" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 295.559 295.559" xml:space="preserve">
                            <path
                                d="M294.626,88.215c-2.388-17.766-9.337-34.209-20.099-47.555c-9.956-12.346-22.871-21.525-36.365-25.844
	c-10.026-3.201-19.906-4.824-29.374-4.824c-24.577,0-46.313,10.811-62.147,30.678c-17.638-20.154-38.392-30.355-61.812-30.357
	c-8.839,0-18.06,1.516-27.408,4.502c-13.505,4.32-26.423,13.498-36.382,25.844C10.274,54.004,3.322,70.449,0.934,88.215
	c-3.858,28.701,4.289,60.008,23.562,90.533c22.278,35.285,59.255,69.889,109.904,102.848c3.989,2.598,8.617,3.971,13.381,3.971
	c4.764,0,9.392-1.373,13.383-3.973c50.646-32.957,87.623-67.561,109.9-102.848C290.335,148.221,298.482,116.916,294.626,88.215z" />
                        </svg>
                    </div>
                    <span>
                        {{ $post->likedUsers()->count() }}
                    </span>
                @endif
            </div>
            @if (Auth::check())
                <div class="col-md-9 border-bottom">
                    <h4>Залишити коментар</h4>
                    <form class="form__comment" action="{{ route('comment.store', [Auth::user(), $post]) }}" method="post"
                        enctype='multipart/form-data'>
                        @csrf
                        <div style="padding-top: 20px;">
                            <textarea id="text" name="text" class="input-group mb-3" placeholder="Ваше повідомлення"
                                class="feedback__textarea" required=""></textarea>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="name">Картинка</span>
                                <div class="input-group mb-3">
                                    <input type="file" name="img" style="padding-top: 20px;" id="inputGroupFile02">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button data-routeComment="{{ route('comment.store', [Auth::user(), $post]) }}"
                                    class="btn btn-primary">Відправити</button>
                            </div>
                        </div>
                    </form>
                    <div class="alert">
                    </div>
                </div>
            @endif
            @if ($comments->count() > 0)
                <h3>Коментарі</h3>
                <div class="col-md-9 border-bottom">
                    @forelse ($comments as $user)
                        <div class="col-md-12">
                            <p class="lead">{{ $user->name }}</p>
                        </div>
                        @foreach ($user->comments as $comment)
                            @if ($loop->even)
                                <div class="col-md-12">
                                    <p>{{ $comment->description }}</p>
                                </div>
                                @if ($comment->img)
                                    <img style="max-width: 100%; margin-bottom: 10px"
                                        src="{{ asset("/storage/img/comments/$comment->img") }}" alt="">
                                @endif
                            @else
                                <div class="col-md-12">
                                    <p>{{ $comment->description }}</p>
                                </div>
                                @if ($comment->img)
                                    <img style="max-width: 100%; margin-bottom: 10px"
                                        src="{{ asset("/storage/img/comments/$comment->img") }}" alt="">
                                @endif
                            @endif
                        @endforeach
                    @empty
                    @endforelse
                </div>
            @endif

        </div>
    </div>
@endsection
