@extends('layouts.layout')


@section('title', 'Investmedia - search')

<div class="page-title db">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>Результат поиска: {{ $s }}</h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                    <li class="breadcrumb-item active">Поиск</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if ($posts->count())
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
                            <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                                   title="">{{ $post->title }}</a></h4>
                            {!! $post->description !!}
                            <small><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                      title="">{{ $post->category->title }}</a></small>
                            <small>{{ $post->getPostDate() }}</small>
                            <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->

                    <hr class="invis">
                @endforeach
            @else
                <h4> Нет публикаций по вашему запросу </h4>
            @endif
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->appends(['s' => request()->s])->links() }} {{-- доп параметры --}}
            </nav>
        </div><!-- end col --> {{-- http://127.0.0.1:8000/search?s=invest&page=2 --}}
    </div><!-- end row -->

@endsection
