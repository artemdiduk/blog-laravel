@extends('./base')
@section('group')
    home page
@endsection
@section('content')
<div class="container">
    <div style="padding-top: 20px;">
        <div class="row justify-content-end">
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{route('article.create.form')}}">Написать статью</a>
            </div>
        </div>
        <div class="col-md-12">
            <h3 class="display-5">Тема статей {{ $groupName }}</h3>
        </div>
        @foreach ($posts as $post)
            @if ($post)
            <div class="col-md-12 border-bottom">
                <div class="row">
                    <div class="col-4">
                        <a href="{{"$groupSlag/$post->slag"}}">{{$post->name}}</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

</div>
@endsection
