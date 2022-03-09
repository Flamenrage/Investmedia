@extends('layouts.category_layout')

@section('title', 'Blog ' . $user->name)

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Личный кабинет пользователя: {{ $user->name }}</h2>
                    <div class="mt-3">
                        <form class="form-inline">
                            <a href=" {{route('user.update') }}" class="btn pt-3 mr-3"
                               style="background: white !important; color: darkorange !important; text-align:center">Аккаунт</a>
                            <a href=" {{route('user.account') }}" class="btn pt-3"
                               style="background: white !important; color: black !important; text-align:center">Комментарии</a>
                        </form>
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

    <div class="container mt-2">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="page-wrapper">
            <div class="">
                <form role="form" method="post" action="{{ route('user.save') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h4>Личные данные</h4>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email"
                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                   value="{{ $user->email }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Пароль</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Пароль">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div><!-- end page-wrapper -->
    </div><!-- end col -->

    <hr class="invis1">

@endsection
