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
                  <h1> ادخل اللينك الصحيح </h1>
                </div>
            </div>
    </section>
@endsection
@section('footer')
    <!-- chartist chart -->
    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="{{url('resources/assets/plugins/js/chartist.min.js') }}"></script>
    <script src="{{url('resources/assets/plugins/js/chartist-plugin-tooltip.min.js') }}"></script>

@endsection
