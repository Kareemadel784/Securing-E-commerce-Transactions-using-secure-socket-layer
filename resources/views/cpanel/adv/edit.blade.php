@extends('layouts.cpanellayout')
@section('title')
    تعديل بيانات الاعلان
@endsection

@section('header')

@endsection

@section('content')
    <div class="content">
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
        <section class="content">
            <div class="box box-body">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسيه</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/adv')}}">كل المنتجات </a> </li>
                            <li class="breadcrumb-item active">تعديل  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('adv.update',$adv->id)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">مكان الاعلان<span style="color:red;">*</span>:</label>
                                <select class="form-control" name="place">
                                    <option id="cat"  selected>اختر مكان الاعلان </option>
                                    <option   value="0" <?php if ($adv->place == 0) echo "selected";?> >الصفحه الرئيسيه</option>
                                    <option  value="1" <?php if ($adv->place == 1) echo "selected";?> >صفحه عرض المنتج</option>
                                    <option  value="2" <?php if ($adv->place == 2) echo "selected";?> >الموقع</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">صوره الاعلان </label>
                                <input type="file" name="image"  class="form-control"   enctype="multipart/form-data">
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu">تعديل </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
@endsection