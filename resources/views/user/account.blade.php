@extends('layouts.category_layout')

@section('title', 'Blog ' . $user->name)

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Личный кабинет пользователя: {{ $user->name }}</h2>
                    <div class="mt-3">
                        <a href=" {{route('user.update') }}" class="btn pt-3 mr-3 "
                           style="background: white !important; color: black !important; text-align:center">Аккаунт</a>
                        <a href=" {{route('user.account') }}" class="btn pt-3 "
                           style="background: white !important; color: darkorange!important; text-align:center">Комментарии</a>
                    </div>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Аккаунт</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
@endsection

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if($comments->count())
                <div class="custombox clearfix">
                    <h4 class="small-title"> {{$comments->count()}}
                        @if($comments->count() == 1)
                            comment
                        @else
                            comments
                        @endif
                    </h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="comments-list">
                                @foreach($comments as $comment)
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading user_name"><a href="{{route('posts.single', ['slug' => $comment->post->slug])}}">Post: {{$comment->post->title}}
                                                </a><small>{{$comment->getCommentDate()}}</small></h4>
                                            <p>{{$comment->content}}</p>
                                        </div>
                                                <form
                                                    action="{{ route('comments.destroy', ['comment' => $comment->post_id]) }}"
                                                    method="post" class="float-right">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="text" name="post_id" hidden
                                                           class="form-control" id="post_id"
                                                           value="{{ $comment->post_id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Подтвердите удаление')">
                                                        Delete
                                                    </button>
                                                </form>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end custom-box -->
            @else
                <h4> There are no your comments yet. Please add a review to our posts. </h4>
            @endif
            <hr class="invis1">
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $comments->links() }}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
