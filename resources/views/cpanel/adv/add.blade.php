@extends('layouts.cpanellayout')
@section('title')
    اضافه اعلان جديده
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
            <!-- left column -->
            <div class="col-md-12">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسيه</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/role')}}">الاقسام </a> </li>
                            <li class="breadcrumb-item active">اضافة </li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('adv.store')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data"  >
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">مكان الاعلان<span style="color:red;">*</span>:</label>
                                <select class="form-control" name="place">
                                    <option id="cat"  selected>اختر مكان الاعلان </option>
                                        <option   value="0">الصفحه الرئيسيه</option>
                                        <option  value="1">صفحه عرض المنتج</option>
                                        <option  value="2">الموقع</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">صوره الاعلان </label>
                                <input type="file" name="image"  class="form-control"   enctype="multipart/form-data"  required>
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
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection