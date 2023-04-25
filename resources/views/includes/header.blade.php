<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">Головна</a>

                </li>

                @if (!Auth::check())
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Авторизація</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registration')}}">Реєстрація</a>
                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('account')}}">Профіль</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
