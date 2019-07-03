@extends('layouts.cpanellayout')
@section('title')
    تعديل بيانات القسم
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
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/gove')}}">{{trans('app.gove')}} </a> </li>
                            <li class="breadcrumb-item active">{{trans('app.edit')}}  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('gove.update',$gove[0]->ids)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">  {{trans('app.gove')}}  <span style="color:red;">*</span>:</label>
                                <input name="gove" type="text" value="{{$gove[0]->gove}}"  class="form-control" id="name"  required />
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.goveenglish')}}  <span style="color:red;">*</span>:</label>
                                <input name="goveenglish" type="text" value="{{$gove[1]->gove}}" class="form-control" id="name"  required />
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