@extends('layouts.layout')


@section('title', 'Публикация - ' . $post->title)


@section('content')
    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('categories.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                </li>
                <li class="breadcrumb-item active">{{$post->title}}</li>
            </ol>

            <span class="color-yellow"><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                          title="">{{ $post->category->title }}</a></span>
            <h3>{{$post->title}}</h3>

            <div class="blog-meta big-meta">
                <small>{{ $post->getPostDate() }}</small>
                <small><i class="fa fa-eye mr-1"></i>{{$post->views}}</small>
            </div><!-- end meta -->
        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">
            {!! $post->content !!}
        </div><!-- end content -->

        <div class="blog-title-area">
            @if (count($post->tags))
                <div class="tag-cloud-single">
                    <span>Теги</span>
                    @foreach($post->tags as $tag)
                        <small><a href="{{ route('tags.single', ['slug' => $tag->slug]) }}" title="">{{$tag->title}}</a></small>
                    @endforeach
                </div><!-- end meta -->
            @endif
            <!--<div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-share"></i> <span
                                class="down-mobile">Share on ...</span></a></li>
                </ul>
            </div>-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                        <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                    </div><!-- end banner-img -->
                </div><!-- end banner -->
            </div><!-- end col -->
        </div><!-- end row -->

        <hr class="invis1">

        @if($comments->count())
        <div class="custombox clearfix">
            <h4 class="small-title"> {{$comments->count()}}
                @if((($comments->count()) % 10) == 1)
                    комментарий
                @elseif($comments->count() % 10 >= 2
                    && $comments->count() % 10 < 5)
                    комментария
                @else
                    комментариев
                @endif
            </h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="comments-list">
                        @foreach($comments as $comment)
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading user_name">{{$comment->user->name}}<small>{{$comment->getCommentDate()}}</small></h4>
                                <p>{{$comment->content}}</p>
                            </div>
                            @if(Auth::check())
                                @if( $comment->user->id == Auth::id() || auth()->user()->is_admin )
                                    <form
                                        action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                                        method="post" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="post_id" hidden
                                               class="form-control" id="post_id"
                                               value="{{ $post->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm mt-3"
                                                onclick="return confirm('Подтвердите удаление')">
                                           Удалить
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end custom-box -->
        @endif
        <hr class="invis1">
    @if(Auth::check())
        <div class="custombox clearfix">
            <h4 class="small-title">Оставить комментарий</h4>
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" method="post"
                          action="{{ route('comments.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="post_id" hidden
                                   class="form-control" id="post_id"
                                   value="{{ $post->id }}">
                        </div>
                        <div class="form-group">
                            <input type="text" hidden
                                   name="user_id"
                                   class="form-control" id="user_id"
                                   value="{{ Auth::id() }}">
                        </div>
                        <div class="form-group">
                            <label class="mb-3" for="content">Ваш комментарий</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                      id="content" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Отправить</button>
                    </form>

                </div>
            </div>
        </div>
        @else
            <div class="custombox clearfix col-md-12 text-center">
                <h4 class="small-title">Чтобы оставить комментарий - авторизуйтесь</h4>
                <a href="{{route('login') }}"
                   class="btn btn-default pt-3 text-center">Войти</a>
            </div>
        @endif
    </div><!-- end page-wrapper -->
@endsection
