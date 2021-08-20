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
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @if(Auth::check())
                        @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">Management</a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.account') }}">Account</a>
                            </li>
                        @endif
                        <li><a class="nav-link" href="{{ route('login.logout') }}">Leave</a></li>
                        @else
                        </li>
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.create') }}">Register</a>
                        </li>
                    @endif
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link"
                           style="color: #000000 !important;"
                           data-toggle="dropdown" href="#">Categories</a>
                        <ul class="dropdown-menu">
                            @foreach($cats_name as $cat)
                                <li><a class="nav-link" href="{{ route('categories.single', ['slug' => $cat->slug]) }}">{{ $cat->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="form-inline" method="get" action="{{ route('search') }}">
                    <input name="s" class="form-control mr-sm-2" type="text" placeholder="How may I help?" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
