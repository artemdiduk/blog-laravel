@extends('./base')
@section('title')
    {{ $post->name }} update
@endsection
@section('content')
    <div class="container">
        <div style="padding-top: 20px;">
            <form action="{{ route('article.update', $post) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Назва</span>
                        <input value="{{ $post->name }}" type="text" required name="name"
                            placeholder="Назва стати" class="form-control" aria-label="Назва стати"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Змінити</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('article.update', $post) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Опис тексту</span>
                        <textarea type="text" required name="description" class="form-control-plaintext border-bottom">{{ $post->description }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Змінити</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
            </form>
            <form action="{{ route('article.update', $post) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Картинка</span>
                        <div class="input-group mb-3">
                            <input type="file" name="img" style="padding-top: 20px;" id="inputGroupFile02">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Змінити</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
            </form>
            <form action="{{ route('article.update', $post) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div style="padding-top: 20px;">
                    <div class="input-group mb-3">
                        <select name="group" id="pet-select">
                            <option value="{{ $thisGroup->id }}">{{ $thisGroup->name }}</option>    
                            @foreach ($groups as $group)
                                @if ($group->name != $thisGroup->name)
                                   <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-primary">Змінити</button>
                    </div>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
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
