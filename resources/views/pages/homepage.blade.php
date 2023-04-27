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
                <button class="btn btn-primary create" data-toggle="modal" data-target="#exampleModal">Створити тему</button>
            </div>
            @endif
        </div>
        <div class="col-md-12 border-bottom">
        @foreach ($groups as $group)
            <div class="row">
                <div class="col-12">
                    <a href="{{route("group", $group)}}">{{$group->name}}</a>
                </div>
            </div>
        @endforeach
        </div>
      
    </div>
</div>
    @if (Auth::check())
        @include('includes/form-create-group')
    @endif
@endsection
