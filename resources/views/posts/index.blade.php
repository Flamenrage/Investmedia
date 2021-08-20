@extends('layouts.layout')


@section('title', 'Investmedia - Home')

@section('header')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2 class="text-dark" style="color: black">Investmedia - a digital blog</h2>
                    <p class="lead text-dark" style="color: black; font-weight: bold; font-size: 18px;"><span
                            style="padding: 0 10px;
	                        background: rgb(249,202,39,0.6);border-radius: 25px"
                        > To enjoy a
                        comfortable future, investing is absolutely essential for most people. And if you’ll want to
                        invest, have an adequate emergency fund and be able to ride out the ups and downs of the market without needing
                        to access your money - follow us and check our posts.</span></p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="newsletter-widget text-center align-self-center">
                        @if(Auth::check())
                            <h3>Welcome, @if(auth()->user()->is_admin) Administrator! @else User! @endif</h3>
                            <p>Check our latest posts below! You can go to your profile by using the link. Have fun!</p>
                            <a href=" @if(auth()->user()->is_admin) {{route('admin.index') }} @else {{route('user.account')}} @endif"
                               class="btn btn-default btn-block pt-3">Account</a>
                        @else
                            <h3>Become our member!</h3>
                            <p>Sign in or sign up to become a member of Investmedia today!</p>
                            <form class="form-inline">
                                <a href=" {{route('register.create') }}" class="btn btn-block pt-3"
                                   style="background: white !important; color: black !important; text-align:center">Create
                                    an account</a>
                                <a href=" {{route('login') }}" class="btn btn-default btn-block pt-3">Login</a>
                                {{-- <input type="text" name="email" placeholder="Add your email here.." required
                                       class="form-control"/>
                                <input type="submit" value="Subscribe" class="btn btn-default btn-block"/>--}}
                            </form>
                        @endif
                    </div><!-- end newsletter -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @foreach($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                            class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                            class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div><!-- end post-sharing -->
                        <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                               title="">{{ $post->title }}</a></h4>
                        <p>{!! $post->description !!}</p> {{-- Читаем html теги --}}
                        <small><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                  title="">{{ $post->category->title }}</a></small>
                        <small>{{ $post->getPostDate() }}</small>
                        <small><i class="fa fa-eye mr-1"></i>{{$post->views}}</small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->

                <hr class="invis">
            @endforeach
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{$posts->links()}}
                {{-- <ul class="pagination justify-content-center">
                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <li class="page-item">
                         <a class="page-link" href="#">Next</a>
                     </li>
                 </ul>--}}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
