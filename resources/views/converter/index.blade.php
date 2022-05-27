@extends('layouts.layout')


@section('title', 'Investmedia - currency converter')

<div class="page-title db">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>Конвертер валют</h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                    <li class="breadcrumb-item active">Конвертер валют</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            <div class="sketchfab-embed-wrapper">
                <iframe title="Investmedia" frameborder="0" allowfullscreen mozallowfullscreen="true"
                        webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking
                        execution-while-out-of-viewport execution-while-not-rendered web-share width="650" height="400"
                        src="https://sketchfab.com/models/60ce360716f0446a9006f688cc6e640c/embed" style="border-radius: 24px"></iframe>
                <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;"> </div>
            <h4 class="text-center font-weight-bold">
                Конвертируйте необходимую сумму:
            </h4>
            <div class="jumbotron">
                <form>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-group mb-3 col-sm-5">
                            <div class="input-group-prepend">
                                <select id="leftSelect" class="btn btn-outline-secondary dropdown-toggle">
                                    @foreach($valuteProps as $id => $v)
                                        <option>{{ $id }}</option>
                                    @endforeach
                                    <option>RUB</option>
                                </select>
                            </div>
                            <input type="text" id="leftPrice" class="form-control">
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="input-group mb-3 col-sm-5">
                            <div class="input-group-prepend">
                                <select id="rightSelect" class="btn btn-outline-secondary dropdown-toggle">
                                    @foreach($valuteProps as $id => $v)
                                        <option>{{ $id }}</option>
                                    @endforeach
                                    <option>RUB</option>
                                </select>
                            </div>
                            <input type="text" id="rightPrice" class="form-control">
                        </div>
                    </div>
                </form>
                {{--{{ var_dump($errors) }}--}}
                <div id="errors"></div>
            </div>
        </div>
    </div>
    <script src="{{URL::asset('js/currencies.js')}}"></script>
@endsection
