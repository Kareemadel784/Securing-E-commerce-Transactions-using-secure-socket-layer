@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.client')}}
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
                            <li class="breadcrumb-item"><a href="{{url('admin')}}"> {{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/client')}}"> {{trans('app.client')}} </a> </li>
                            <li class="breadcrumb-item active"> {{trans('app.edit')}}  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('client.update',$client->id)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name"> {{trans('app.name')}} <span style="color:red;">*</span>:</label>
                                <input name="name" value="{{$client->name}}" type="text" class="form-control" id="name" placeholder="العميل " required />
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.telephone')}} <span style="color:red;">*</span>:</label>
                                <input name="telephone" value="{{$client->telephone}}" type="text" class="form-control" id="name" placeholder="رقم التليفون " required />
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.email')}}  <span style="color:red;">*</span>:</label>
                                <input name="email" type="email" value="{{$client->email}}" class="form-control" id="name" placeholder="البريد الالكتروني " required />
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.password')}} <span style="color:red;">*</span>:</label>
                                <input name="password" type="password" class="form-control" id="name"   required />
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu"> {{trans('app.edit')}}</button>
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