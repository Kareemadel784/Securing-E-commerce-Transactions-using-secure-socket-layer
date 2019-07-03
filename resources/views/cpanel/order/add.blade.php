@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.order')}}
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
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}} </a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/product')}}">{{trans('app.order')}}  </a> </li>
                            <li class="breadcrumb-item active">{{trans('app.add')}}</li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('order.store')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('app.client')}} <span style="color:red;">*</span>:</label>
                                <select class="form-control" name="client_id">
                                    <option id="cat"  selected>  {{trans('app.client')}} </option>
                                    @foreach($client as $clients)
                                        <option id="cat" name="cat" value="{{$clients->id}}">{{$clients->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.captin')}} <span style="color:red;">*</span>:</label>
                                <select class="form-control" name="captin_id">
                                    <option id="cat"  selected>{{trans('app.captin')}}  </option>
                                    @foreach($captin as $captins)
                                        <option id="cat" name="cat" value="{{$captins->id}}">{{$captins->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.village')}}  <span style="color:red;">*</span>:</label>
                                <select class="form-control" name="village_id">
                                    <option  selected>{{trans('app.village')}}  </option>
                                    @for($i=0;$i<count($price);$i++)
                                        <option  value="{{$price[$i]->village_id}}">{{$price[$i]->village}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name"> {{trans('app.address')}} <span style="color:red;">*</span>:</label>
                                <input name="address" placeholder="ادخل العنوان التفصيلي ..."  class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.product')}}  <span style="color:red;">*</span>:</label> <br>
                                @for($i=0;$i<count($product);$i++)
                                    <div class="row">
                                        <input  type="checkbox" style=" position: initial;right: -9999px;opacity: 01;"
                                                id="edit-node-types-article"  name="product[]"value="{{$product[$i]->id}}">  <span class="col-md-4"> {{ $product[$i]->name }}</span>
                                        <input  class="col-md-1"name="que[]" value="1"  id="checkbox2" type="text" style="width: 29px;height: 25px; margin: 5px" class="js-switch"  />
                                        <input  class="col-md-1"name="price[]" value="{{$product[$i]->price}}"  id="checkbox2" type="hidden" style="width: 29px;height: 25px; margin: 5px" class="js-switch"  />
                                        <input  class="col-md-1"name="offer[]" value="{{$product[$i]->offer}}"  id="checkbox2" type="hidden" style="width: 29px;height: 25px; margin: 5px" class="js-switch"  />
                                        <br>
                                    </div>
                                @endfor
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
