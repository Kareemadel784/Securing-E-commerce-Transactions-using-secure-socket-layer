@extends('layouts.websitlayout')
@section('title')
    {{trans('app.about')}}
@endsection

@section('header')

@endsection
@section('content')
    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>{{trans('app.about')}}</h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{url('/')}}">{{trans('app.home')}}</a></li>
                        <li><span>{{trans('app.about')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- About Page -->

    <div class="about_page_area fix">
        <div class="container">
            <div class="row about_inner">
                <div class="about_img_area col-lg-6 col-md-12 col-xs-12">
                    <div data-video="NrmMk1Myrxc" id="video">
                        <img src="{{url('resources/assets/websit/img/screenshot.jpg')}}" alt="Video Screenshot">
                    </div>
                </div>

                <div class="about_content_area col-lg-6  col-md-12 col-xs-12">
                    <h2>{{trans('app.about')}}</h2>
                    <p> {{$about[0]->aboutapplication}}</p>
                </div>

            </div>
        </div>
    </div>


@endsection