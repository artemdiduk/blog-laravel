@extends('./base')
@section('title')
    Тема статей {{ $group->name }}
@endsection
@section('content')
<div class="container">
    <div style="padding-top: 20px;">
        @if (Auth::check())
        <div class="row justify-content-end">
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{route('article.create.form', $group)}}">Написать статью</a>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <h3 class="display-5">Тема статей {{ $group->name }}</h3>
        </div>
        @foreach ($posts as $post)
            @if ($post)
            <div class="col-md-12 border-bottom">
                <div class="row">
                    <div >
                        <a href="{{route("article", [$group, $post])}}">{{$post->name}}</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

</div>
@endsection
