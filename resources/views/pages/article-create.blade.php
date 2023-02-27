@extends('./base')
@section('group')
    Articl Create page
@endsection
@section('content')
<div class="container">
<form action="{{route("article.create")}}" method="post" enctype='multipart/form-data'>
     @csrf
    <div style="padding-top: 20px;">
        <div class="col-md-12">
            <h4 class="display-6">Создание статьи</h4>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="name">Название</span>
            <input type="text" required name="name" placeholder="Название стати" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="description">Описание статьи</span>
            <textarea type="text" required name="description" class="form-control-plaintext border-bottom"></textarea>
        </div>
        <h4>Картинки</h4>
        <div class="input-group mb-3">
            <input type="file"  name="imag" class="form-check" id="inputGroupFile02">
        </div>
        <p>Категория</p>
        <select name="group" id="pet-select">
            @foreach ($groups as $group)
                 <option value="{{$group->slag}}">{{$group->name}}</option>
            @endforeach
        </select>
        <div class="input-group mb-3">
            <button class="btn btn-primary">Создать</button>
        </div>
    </div>
</form>   
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
</div>
@endsection
