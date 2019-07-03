@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.village')}}
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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/subcategory')}}">{{trans('app.village')}} </a> </li>
                            <li class="breadcrumb-item active">{{trans('app.add')}} </li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('village.store')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data"  >
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('app.area')}}<span style="color:red;">*</span>:</label>
                                <select class="form-control" name="area_id">
                                    <option id="cat" disabled selected>{{trans('app.area')}}   </option>
                                    @for($i=0;$i<count($area);$i++)
                                        <option  value="{{$area[$i]->ids}}">{{$area[$i]->area}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.village')}}<span style="color:red;">*</span>:</label>
                                <input name="village" type="text" class="form-control" id="name"  required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.villageenglish')}}<span style="color:red;">*</span>:</label>
                                <input name="villageenglish" type="text" class="form-control" id="name"  required />
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu">تعديل</button>
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