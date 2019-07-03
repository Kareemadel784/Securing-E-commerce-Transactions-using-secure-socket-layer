@extends('layouts.cpanellayout')
@section('title')
    اضافه صلاحيات
@endsection

@section('header')

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content">



    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                     <div class="row page-titles">
                            <div class="col-md-5 col-8 align-self-center">
                                <h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسيه</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/permission')}}">الصلاحيات</a> </li>
                                    <li class="breadcrumb-item active">اضافة </li>
                                </ol>
                            </div>
                        </div>
                    <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('permission.store')}}" method="post" role="form" accept-charset="utf-8">
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group col-md-12">
                                <label for="name"> الاسم <span style="color:red;">*</span>:</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="" required="required"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="display_name"> ضع اسم <span style="color:red;">*</span>:</label>
                                <input name="display_name" type="text" class="form-control" id="display_name" placeholder="" required="required"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description"> الوصف  <span style="color:red;">*</span>:</label>
                                <input name="description" type="text" class="form-control" id="description" placeholder="" required="required"/>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu">اضافه</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

{{--
<script src="{{ url('resources/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
--}}
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