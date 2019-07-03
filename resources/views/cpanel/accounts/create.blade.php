@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.account')}}
@endsection

@section('header')

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content">
    <!-- Content Header (Page header) -->
    @if (\Session::has('message'))
        <div class="col-xs-12">
            <div class="alert alert-success">
                <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                <strong>فشل في الانتقال  !</strong>لا تملك الصلاحيه
            </div>
        </div>
@endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                <strong>خطاء!</strong> رجاء ادخال بيانات صحيحه<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <!-- left column -->
            <div class="col-md-12">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}"> {{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/account')}}"> {{trans('app.account')}} </a> </li>
                            <li class="breadcrumb-item active">اضافة </li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  action="{{route('account.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field () }}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> {{trans('app.name')}}</label>
                                <input required type="text" class="form-control" name="name" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">  {{trans('app.email')}}</label>
                                <input class="form-control" rows="8" required name="email"  type="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">  {{trans('app.password')}}</label>
                                <input name="row_password"  id="password" type="password" class="form-control"  required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> {{trans('app.confirmpassword')}}</label>
                                <input name="remember_token"  id="password-confirm" type="password" class="form-control" required="required"/>

                            </div>
                            <div id='custmessage'>
                            </div>
                            <div class="col-sm-12 form-group">
                                @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="role_name[]" value="{{$role->id}}" style="position: initial;right: -9999px;opacity: 1;">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        {{$role->name}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu"> {{trans('app.add')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script src="{{ url('resources/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('#genpass').click(function () {
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#password-confirm').val(randomstring);
        $('#custmessage').addClass('col-sm-4');
        $('#custmessage').addClass('alert-success');
        $('#custmessage').html('The generated password will be sent to your email');
    });
});
</script>
@endsection