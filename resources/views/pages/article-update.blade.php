@extends('./base')
@section('title')
   {{ $postName  }} update
@endsection
@section('content')
<div class="container">
    <div style="padding-top: 20px;">
       <form action="{{route("article.update", $post)}}" method="post" enctype='multipart/form-data'>
                @csrf

                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Название</span>
                        <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}" />
                        <input value="{{ $postName }}" type="text" required name="name" placeholder="Название стати" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Изменить</button>
                    </div>
                </div>
        </form>
       <form action="{{route("article.update", $post)}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Описание текста</span>
                         <textarea type="text" required name="description" class="form-control-plaintext border-bottom">{{ $postDescription }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Изменить</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}" />
        </form>
       <form action="{{route("article.update", $post)}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Картинка</span>
                        <div class="input-group mb-3">
                            <input type="file"  name="img" style="padding-top: 20px;" id="inputGroupFile02">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Изменить</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}" />
        </form>
        <form action="{{route("article.update", $post)}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                    <select name="group" id="pet-select">
                        @foreach ($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Изменить</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}" />
        </form>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection


