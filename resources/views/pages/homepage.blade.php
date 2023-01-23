@extends('./base')
@section('title')
    home page
@endsection
@section('content')
  <div class="container">
    <div style="padding-top: 20px;">
        <div class="row justify-content-end">
            @if (Auth::check())
                <div class="col-md-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Создать тему</button>
            </div>
            @endif
        </div>
        <div class="col-md-12 border-bottom">
            <div class="row">
                <div class="col-4">
                    <a href="group.html">Название темы</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
