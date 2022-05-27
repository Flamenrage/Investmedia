<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/assets/front/images/version/mark-logo.png"
                                                                    alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link"
                           style="color: #000000 !important;"
                           data-toggle="dropdown" href="#">Категории</a>
                        <ul class="dropdown-menu">
                            @foreach($cats_name as $cat)
                                <li><a class="nav-link" href="{{ route('categories.single', ['slug' => $cat->slug]) }}">{{ $cat->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('converter.index') }}">Конвертер валют</a>
                    </li>
                    @if(Auth::check())
                        @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">Управление</a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.account') }}">Личный кабинет</a>
                            </li>
                        @endif
                        <li><a class="nav-link" href="{{ route('login.logout') }}">Выйти</a></li>
                        @else
                        </li>
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.create') }}">Регистрация</a>
                        </li>
                    @endif
                </ul>
                <form class="form-inline" method="get" action="{{ route('search') }}">
                    <input name="s" class="form-control mr-sm-2" type="text" placeholder="Что нужно найти?" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
