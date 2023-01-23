@extends('./base')
@section('title')
    login
@endsection
@section('content')
  <div class="container">
    <div style="padding-top: 20px;">
        <div class="row justify-content-center">
            <form action="{{route('authenticate')}}" class="col-md-7 border" method="POST"  enctype="multipart/form-data">
                @csrf
                <h3>Авторизация</h3>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="text" required name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Пароль</label>
                    <input type="text" required name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary btn">Войти</button>
                </div>
            </form>
        </div>
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
