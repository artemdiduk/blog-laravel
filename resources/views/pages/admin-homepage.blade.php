@extends('./admin-base')
@section('title')
    admin page
@endsection
@section('content')
  <div class="container">
    <div style="padding-top: 20px;">
       <h1>Контент на сайте</h1>
        <div class="wrapper">
            <h2>Всех постов {{ $postCount }}</h2>
        </div>

    </div>
    <div style="padding-top: 20px;">
        <div class="wrapper">
            @foreach ($contents as $content)
                <h2>Група <a href="/group/{{$content->slag}}">{{$content->name}}</a></h2>
                <form action="{{route('group.delate', $content)}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="col-md-2" style="padding-left: 0px">
                        <button type="submit" class="btn btn-primary create" >Удалить Групу</button>
                    </div>
                </form>
                <div class="col-md-2" style="padding-left: 0px; margin-top: 10px">
                    <a href="{{route('update.group.from', $content)}}" class="btn btn-primary create">Изменить групу</a>
                </div>
                <div class="wrapper__posts">
                    @foreach ($content->posts as $post)
                        <h3>Пост <a href="{{$content->slag}}/{{ $post->slag }}">{{ $post->name }}</a></h3>
                        <div class="col-md-2" style="padding-left: 0px">
                            <a href="{{route('article.update.form', ['post_id' => $post->id])}}" class="btn btn-primary create" data-toggle="modal" data-target="#exampleModal">Изменить саттю</a>
                        </div>
                        <form action="{{route("article.delate")}}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method("DELETE")
                            <div style="padding-top: 20px;">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
                                    <button class="btn btn-primary">Удалить пост</button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>


@endsection
