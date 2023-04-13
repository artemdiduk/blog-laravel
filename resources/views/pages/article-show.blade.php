@extends('./base')
@section('title')
    {{ $postName }}

@endsection
@section('content')
    <div class="container">
        @if (Auth::id() == $author->id)
            <div class="col-md-2">
                <a href="{{route('article.update.form', ['post_id' => $postId])}}" class="btn btn-primary create"
                   data-toggle="modal" data-target="#exampleModal">Изменить саттю</a>
            </div>
        @endif
        @if (Auth::id() == $author->id)
            <form action="{{route("article.delate")}}" method="post" enctype='multipart/form-data'>
                @csrf
                @method("DELETE")
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}"/>
                        <button class="btn btn-primary">Удалить пост</button>
                    </div>
                </div>
            </form>
        @endif

        <div style="padding-top: 20px;">
            <div class="col-md-12">
                <h3 class="display-6">{{ $postName }}</h3>
            </div>
            <div class="col-md-12 border-bottom">
                <div class="row">
                    <div class="col-12">
                        <img src="" alt="">
                        <p>{{ $postDescription }}</p>
                    </div>
                </div>
                @if ($postImg)
                    <div class="col-12">
                        <img style="width: 100%" src="/storage/img/posts/{{$postImg}}" alt="{{ $postName }}">
                    </div>
                @endif
            </div>

            @if(Auth::check())
                <div class="col-md-9 border-bottom">
                    <h4>Оставить Комментарий</h4>
                    <form class="form__comment" action="{{route('comment.store', [Auth::user(), $post] )}}"
                          method="post"
                          enctype='multipart/form-data'>
                        @csrf
                        <div style="padding-top: 20px;">
                            <textarea id="text" name="text" class="input-group mb-3" placeholder="Ваше сообщение"
                                      class="feedback__textarea" required=""></textarea>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="name">Картинка</span>
                                <div class="input-group mb-3">
                                    <input type="file" name="img" style="padding-top: 20px;" id="inputGroupFile02">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-primary">Отправить</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        let routeFormComment = "{{route('comment.store', [Auth::user(), $post] )}}";
                    </script>

                    <div class="alert">

                    </div>

                </div>
            @endif
            <h3>Комментарий</h3>
            <div class="col-md-9 border-bottom">
                @forelse ($comments as $user)
                    <div class="col-md-12">
                        <p class="lead">{{$user->name}}</p>
                    </div>
                    @foreach($user->comments as $comment)
                        @if ($loop->even)
                            <div class="col-md-12">
                                <p>{{$comment->description}}</p>
                            </div>
                            @if($comment->img)
                                <img style="max-width: 100%; margin-bottom: 10px"
                                     src="{{asset("/storage/img/comments/$comment->img")}}" alt="">
                            @endif
                        @else
                            <div class="col-md-12">
                                <p>{{$comment->description}}</p>
                            </div>
                            @if($comment->img)
                                <img style="max-width: 100%; margin-bottom: 10px"
                                     src="{{asset("/storage/img/comments/$comment->img")}}" alt="">
                            @endif
                        @endif
                    @endforeach
                @empty

                @endforelse

            </div>
        </div>
    </div>
@endsection
