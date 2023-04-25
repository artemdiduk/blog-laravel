@extends('./admin-base')
@section('title')
    Users get
@endsection
@section('content')
    <div class="container">
        <div style="padding-top: 20px;">
            <h1>Контент користувачів</h1>
            <div class="wrapper">
                <h2>Усіх Користувачів {{count($users)}}</h2>
            </div>

        </div>
        <div style="padding-top: 20px;">
            <div class="wrapper">
                @foreach($users as $user)
                    <div class="col-md-12" style="padding-left: 0px; margin-top: 10px">
                        <h3>Ім'я користувача <a href="{{route("admin.account.users", $user)}}">{{$user->name}}</a></h3>
                        @if(!$user->group->isEmpty())
                            <h4> Групи створені автором</h4>
                            @foreach($user->group as $group)
                                <h5><a href="/group/{{$group->slag}}">{{$group->name}}</a></h5>
                            @endforeach
                        @endif
                        @if(!$user->posts->isEmpty())
                            <h4> Пости створені автором</h4>
                            @foreach($user->posts as $post)
                            @php
                                $groupPost = $group->find($post->group_id);
                            @endphp
                                <h5><a href="/{{$groupPost->slag}}/{{$post->slag}}">{{$post->name}}</a></h5>
                            @endforeach
                        @endif
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>


@endsection
