@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Комментарии</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список комментариев</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($comments->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Контент</th>
                                            <th style="width: 30px">id пользователя</th>
                                            <th>Email пользователя</th>
                                            <th>Публикация</th>
                                            <th>Дата</th>
                                            <th style="width: 30px">Управление</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>{{ $comment->content }}</td>
                                                <td>{{ $comment->user_id }}</td>
                                                <td>{{ $comment->user->email }}</td>
                                                <td>
                                                    <a href="{{ route('posts.single', ['slug' => $comment->post->slug]) }}"
                                                       target="_blank">
                                                        {{ $comment->post->title }}
                                                    </a>
                                                </td>
                                                <td>{{ $comment->created_at}}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="text" name="post_id" hidden
                                                               class="form-control" id="post_id"
                                                               value="{{ $comment->post->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm mr-3"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Постов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if ($comments->count())
                                {{ $comments->links() }}
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

