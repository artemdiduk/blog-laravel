@extends('./admin-base')
@section('title')
    admin page
@endsection
@section('content')
    <div class="container">
        <div style="padding-top: 20px;">
            <h1>Комментарии на одобрение</h1>

        </div>
        <div style="padding-top: 20px;">
            <div class="wrapper">
                @foreach($posts as $post)
                    <div class="post" data-postId = "{{$post->id}}">
                        <h4>Коментарий к странице <a href="/{{$post->slag_group.'/'.$post->slag}}">{{$post->name}}</a>
                        </h4>
                        @foreach($post->comments as $comment)
                            <div class="comments-author">
                                <h5>Коментарий от {{$users::find($comment->user_id)->name}}</h5>
                                <form class="form__comment-admin" action="{{route('admin.comments.approved',  $comment)}}"
                                      method="post"
                                      enctype='multipart/form-data'>
                                    @csrf
                                    <div style="padding-top: 20px;">
                            <textarea id="text" name="text-{{$comment->id}}" class="input-group mb-3" placeholder="Ваше сообщение"
                                      class="feedback__textarea" required="">{{$comment->description}}</textarea>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="name">Картинка</span>
                                            @if($comment->img)
                                                <img src="{{asset("storage/img/comments/$comment->img")}}" alt="">
                                            @endif
                                            <div class="input-group mb-3">
                                                <input type="file" name="img-{{$comment->id}}" style="padding-top: 20px;"
                                                       id="inputGroupFile02">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button data-idPost="{{route('admin.comments.show',  $post->id)}}"  data-form="{{$comment->id}}" data-route="{{route('admin.comments.approved',  $comment)}}" class="btn btn-primary">Опубликувать</button>
                                        </div>
                                    </div>
                                </form>
                                <form class="form__comment-delete"
                                @csrf
                                @method('DELETE')
                                <button data-idPost="{{route('admin.comments.show',  $post->id)}}" data-route="{{route('admin.comments.delete',  $comment)}}"
                                        class="btn btn-primary">Удалить
                                </button>
                                </form>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
