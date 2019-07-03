@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.price')}}
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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/subcategory')}}">{{trans('app.village')}} </a> </li>
                            <li class="breadcrumb-item active">{{trans('app.edit')}} </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('price.update',$price->id)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('app.village')}}<span style="color:red;">*</span>:</label>
                                <select class="form-control" name="village_id">
                                    <option id="cat"  selected>{{trans('app.village')}}</option>
                                    @foreach($vaillage as $vaillage)
                                        <option  name="gove_id" value="{{$vaillage->village_id}}"  <?php
                                                if ($price->village_id == $vaillage->id)
                                                    echo "selected";
                                            ?> >{{$vaillage->village}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.price')}}  <span style="color:red;">*</span>:</label>
                                <input name="price" value="{{$price->price}}" type="text" class="form-control" placeholder="تكلفه الشحن" required />
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