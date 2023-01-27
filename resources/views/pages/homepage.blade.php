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
<form action="{{route("group.create")}}" method="post">
    @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="group" class="col-form-label">Название темы</label>
                        <input type="text" required="" name="group" class="form-control" id="group">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
@endsection
