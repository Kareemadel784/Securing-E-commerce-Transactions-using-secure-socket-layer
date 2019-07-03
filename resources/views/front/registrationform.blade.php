@extends('layouts.websitlayout')
@section('title')
    {{trans('app.home')}}
@endsection

@section('header')

@endsection
@section('content')
    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>Account</h3>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="#">home</a></li>
                        <li><a href="#">category</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Login Page -->
    <div class="login_page_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="create_account_area caa_pdngbtm">
                        <h2 class="caa_heading">{{trans('app.createaccoun')}}</h2>
                        <div class="caa_form_area">
                            <form action="{{route('registration')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data"  >
                                    {{csrf_field()}}
                                <div class="caa_form_group">
                                    <div class="caf_form">
                                        <div>
                                            <label> {{trans('app.name')}} </label>
                                            <div class="input-area">
                                                <input type="text" name="name" required />
                                            </div>
                                        </div>
                                        <div>
                                            <label> {{trans('app.email')}} </label>
                                            <div class="input-area">
                                                <input type="email" name="email" required />
                                            </div>
                                        </div>
                                        <div>
                                            <label> {{trans('app.password')}} </label>
                                            <div class="input-area">
                                                <input type="password" name="password" required />
                                            </div>
                                        </div>
                                        <div>
                                            <label> {{trans('app.telephone')}} </label>
                                            <div class="input-area">
                                                <input type="text" name="telephone" required />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-default acc_btn" type="submit" id="acc_Create">
                                        <span> <i class="fa fa-user btn_icon"></i> {{trans('app.createaccoun')}} </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="create_account_area">
                        <h2 class="caa_heading"> {{trans('app.registerd')}} </h2>
                        <div class="caa_form_area">
                            <form action="{{route('loginclient')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data"  >
                                {{csrf_field()}}
                                <div class="caa_form_group">
                                    <div class="login_email">
                                        <label> {{trans('app.telephone')}} </label>
                                        <div class="input-area">
                                            <input type="text" name="telephone"  required/>
                                        </div>
                                    </div>
                                    <div class="login_password">
                                        <label> {{trans('app.password')}} </label>
                                        <div class="input-area">
                                            <input type="password" name="password" required/>
                                        </div>
                                    </div>
                                    <button type="submit" id="acc_Login" class="btn btn-default acc_btn">
                                        <span> <i class="fa fa-lock btn_icon"></i> {{trans('app.signin')}} </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection