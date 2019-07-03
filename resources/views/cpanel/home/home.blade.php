@extends('layouts.cpanellayout')

@section('title')
    الرئيسيه
@endsection
@section('header')
    <!-- chartist CSS -->
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/chartist-init.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/chartist-plugin-tooltip.css')}}">
    <link rel="stylesheet" href="{{url('resources/assets/plugins/css/css-chart.css')}}">
    <style>
        .card-inverse
        {
            background-color: #52B657;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        @if (\Session::has('message'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>فشل في الانتقال  !</strong>لا تملك الصلاحيه
                </div>
            </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
        </ol>
        <!-- Small boxes (Stat box) -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="font-light text-white"> عدد الادمن  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$account}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="font-light text-white"> عدد العملاء  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$client}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="font-light text-white"> عدد الطلبات  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$order}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                      <h2 class="font-light text-white"> طلبات اليوم  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$orderday}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="font-light text-white"> عدد المنتجات  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$product}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="font-light text-white"> عدد الزوار  </h2>
                                    </div>
                                    <div class="col-6 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" >
                                            <h2 class="font-light text-white"> {{$vistor}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <div class='onesignal-customlink-container'></div>

@endsection
@section('footer')
    <!-- chartist chart -->
    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="{{url('resources/assets/plugins/js/chartist.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/chartist-plugin-tooltip.min.js') }}"></script>

@endsection
