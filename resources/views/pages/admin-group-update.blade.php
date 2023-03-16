@extends('./admin-base')
@section('title')
   Обновить {{$group->name}}
@endsection
@section('content')
    <div class="container">

        <form action="{{route("update.group", $group)}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div style="padding-top: 20px;">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="name">Название</span>
                    <input  type="text" required name="group" placeholder="Название стати" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-primary">Изменить</button>
                </div>
            </div>
        </form>
    </div>

@endsection
