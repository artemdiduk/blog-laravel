@extends('./base')
@section('title')
   {{ $postName }}
@endsection
@section('content')
<div class="container">
     @if (Auth::id() == $author->id)
        <div class="col-md-2">
            <button class="btn btn-primary create" data-toggle="modal" data-target="#exampleModal">Изменить саттю</button>
        </div>
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
        <div class="col-md-9 border-bottom">
            <div class="col-md-12">
                <p class="lead">Имя автора</p>
            </div>
            <div class="col-md-12">
                <p>Комментарий</p>
            </div>
        </div>
    </div>
</div>
@endsection
