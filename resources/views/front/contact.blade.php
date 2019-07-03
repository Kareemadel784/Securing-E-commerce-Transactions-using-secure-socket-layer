@extends('layouts.websitlayout')
@section('title')
    {{trans('app.contact')}}
@endsection

@section('header')

@endsection
@section('content')
    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>    {{trans('app.contact')}} </h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{url('/')}}">    {{trans('app.home')}}</a></li>
                        <li><span>    {{trans('app.contact')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Page -->
    <div class="contact_page_area fix">
        <div class="container">
            <div class="row">
                <div class="contact_frm_area text-left col-lg-6 col-md-12 col-xs-12">
                    <form role="form"  action="{{route('contactus')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field () }}                        <div class="form-row">
                            <div class="form-group col-sm-6"><input type="text" name="name" class="form-control" placeholder="{{trans('app.name')}}*" /></div>
                            <div class="form-group col-sm-6"><input type="email" name="email" class="form-control" placeholder="{{trans('app.email')}}*" /></div>
                        </div>

                        <div class="form-group">
                            <input type="telephone" name="telephone" class="form-control" placeholder="{{trans('app.telephone')}}" />
                        </div>

                        <div class="form-group">
                            <textarea name="descreption" class="form-control" placeholder="{{trans('app.message')}}"></textarea>
                        </div>

                        <div class="input-area submit-area"><button class="btn border-btn" type="submit" >Send Message</button></div>

                    </form>
                </div>

                <div class="contact_info col-lg-6 col-md-12 col-xs-12">
                    <h3>Contact Info</h3>
                    <p class="subtitle">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                    <div class="single_info">
                        <div class="con_icon"><i class="fa fa-map-marker"></i></div>
                        <p>1660 Travis Street <br />Miramar, FL 33025 </p>
                    </div>
                    <div class="single_info">
                        <div class="con_icon"><i class="fa fa-phone"></i></div>
                        <p>Phone : +772-607-0042</p>
                        <p>Fax : +772-607-0042</p>
                    </div>
                    <div class="single_info">
                        <div class="con_icon"><i class="fa fa-envelope"></i></div>
                        <a href="#">RachelSOntiveros@rhyta.com </a> <br />
                        <a href="#">RachelSOntiveros@rhyta.com </a>
                    </div>

                </div>
            </div>
        </div>


        <div class="fix">
            <div id="contact_map_area"></div>
        </div>

    </div>

@endsection