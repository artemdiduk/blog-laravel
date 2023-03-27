@extends('./admin-base')
@section('title')
    Users get
@endsection
@section('content')
    <div class="container">
        <div style="padding-top: 20px;">
            <h1>Контети юзеров</h1>
            <div class="wrapper">
                <h2>Всех Пользивателей {{count($users)}}</h2>
            </div>

        </div>
        <div style="padding-top: 20px;">
            <div class="wrapper">
                @foreach($users as $user)
                    <div class="col-md-12" style="padding-left: 0px; margin-top: 10px">
                        <h3>Имя юзера <a href="{{route("admin.account.users", $user)}}">{{$user->name}}</a></h3>
                        @if(!$user->group->isEmpty())
                            <h4> Групи создание автором</h4>
                            @foreach($user->group as $group)
                                <h5><a href="/group/{{$group->slag}}">{{$group->name}}</a></h5>
                            @endforeach
                        @endif
                        @if(!$user->posts->isEmpty())
                            <h4> Пости создание автором</h4>
                            @foreach($user->posts as $post)
                                <h5><a href="/{{$post->slag_group}}/{{$post->slag}}">{{$post->name}}</a></h5>
                            @endforeach
                        @endif
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>


@endsection
