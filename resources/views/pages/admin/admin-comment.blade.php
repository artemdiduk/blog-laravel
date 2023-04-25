@extends('./admin-base')
@section('title')
    admin page comment
@endsection
@section('content')
    <div class="container">
        <div style="padding-top: 20px;">
            <h1>Коментарі на схвалення</h1>

        </div>
        <div style="padding-top: 20px;">
            <div class="wrapper">
                @foreach ($posts as $post)
                    <div class="post">
                        <h4>Коментар до сторінки <a
                                href="/{{ $post->slag_group . '/' . $post->slag }}">{{ $post->name }}</a>
                        </h4>
                        @foreach ($post->comments as $comment)
                            <div class="comments-author">
                                <h5>Коментарий от {{ $users::find($comment->user_id)->name }}</h5>
                                <form class="form__comment-admin"
                                    method="post" enctype='multipart/form-data'>
                                    @csrf
                                    <div style="padding-top: 20px;">
                                        <textarea id="text" name="text" class="input-group mb-3" placeholder="Ваше сообщение"
                                            class="feedback__textarea">{{ $comment->description }}</textarea>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="name">Картинка</span>
                                            @if ($comment->img)
                                                <img src="{{ asset("storage/img/comments/$comment->img") }}" alt="">
                                            @endif
                                            <div class="input-group mb-3">
                                                <input type="file" name="img" style="padding-top: 20px;"
                                                    id="inputGroupFile02">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button data-routeComment="{{ route('admin.comments.approved', $comment) }}" class="btn btn-primary approved">Опублікувати</button>
                                        </div>
                                        <div class="alert">
                                            
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="{{ route('admin.comments.delete', $comment) }}"
                                    class="form__comment-delete">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-primary">Видалити
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
