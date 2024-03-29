@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Публикации</h1>
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
                            <h3 class="card-title">Список публикаций</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Добавить
                                пост</a>
                            <br>
                            <div class="form-group float-right">
                                <label for="category_id" class="mr-1">Поиск по запросу:  {{ $s }}, {{$posts->count()}} рез. найдено</label>
                                <br>
                            </div>

                        @if ($posts->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Наименование</th>
                                            <th>Slug</th>
                                            <th>Категория</th>
                                            <th>Теги</th>
                                            <th>Дата</th>
                                            <th>Управление</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->slug }}</td>
                                                <td>
                                                    <a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                                       target="_blank">
                                                        {{ $post->category->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if(count($post->tags))
                                                        @foreach($post->tags as $tag)
                                                            {{ $tag->title }};
                                                        @endforeach
                                                    @else
                                                        there are no tags yet!
                                                    @endif
                                                </td>
                                                {{-- Аналог, используем метод pluck ля коллекций
                                                 <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                                --}}
                                                <td>{{ $post->created_at}}</td>
                                                <td style="width: 8.33%">
                                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1 mb-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                                                       class="btn btn-success btn-sm float-left mr-1 mb-1" target="_blank">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
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
                            @if ($posts->count())
                                {{ $posts->appends(['s' => request()->s])->links() }} {{-- доп параметры --}}
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

