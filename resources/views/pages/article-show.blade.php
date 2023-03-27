@extends('./base')
@section('title')
   {{ $postName }}
@endsection
@section('content')
<div class="container">
     @if (Auth::id() == $author->id)
        <div class="col-md-2">
            <a href="{{route('article.update.form', ['post_id' => $postId])}}" class="btn btn-primary create" data-toggle="modal" data-target="#exampleModal">Изменить саттю</a>
        </div>
    @endif
    @if (Auth::id() == $author->id)
         <form action="{{route("article.delate")}}" method="post" enctype='multipart/form-data'>
                @csrf
             @method("DELETE")
                <div style="padding-top: 20px;">
                     <div class="input-group mb-3">
                         <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}" />
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
                <img  style="width: 100%" src="/storage/img/posts/{{$postImg}}" alt="{{ $postName }}">
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
