@extends('./base')
@section('title')
    Привіт {{ $user->name }}
@endsection
@section('content')

    <div class="container">
        <div style="padding-top: 20px;">
            @if ($user->avatar)
                <div class="col-12">
                    <img width="250" height="250" src="{{ asset("/storage/img/users/$user->avatar") }}"
                        alt="avatar {{ $user->name }}">
                </div>
            @endif
            <h1>Ім'я {{ $user->name }}</h1>
            <h3>
                {{ $user->avatar ? 'Змінити аватарку' : 'Додати аватарку' }}
            </h3>
            <form action="{{ route('user.update', $user) }}" method="post" enctype='multipart/form-data'>
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
            <h2>Ваш контент</h2>
            @forelse ($userGroup as $group)
                <h3>Група <a href="/group/{{ $group->slag }}">{{ $group->name }}</a></h3>
            @empty
                Вибачте, у вас немає створених груп
            @endforelse

            @forelse ($postsCreator as $content)
                <h3>Пости групи <a href="/group/{{ $content->slag }}">{{ $content->name }}</a></h3>
                @foreach ($content->posts as $post)
                    <h6><a href="{{ $content->slag }}/{{ $post->slag }}">{{ $post->name }}</a></h6>
                @endforeach
            @empty
                <p>Нет постов</p>
            @endforelse

            @if (!empty($postLikes))
                <h6>Пости які ви лайкнули: </h6>
                @foreach ($postLikes as $postLike)
                    @php
                       $group = $groups->find($postLike->group_id);
                    @endphp
                    <p><a href="{{ $group->slag }}/{{ $postLike->slag }}">{{ $postLike->name }}</a></p>
                @endforeach
            @endif



        </div>

    </div>
@endsection
