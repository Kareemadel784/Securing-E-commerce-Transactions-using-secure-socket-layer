@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.edit')}}
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
                            <li class="breadcrumb-item"><a href="{{url('admin/category')}}">{{trans('app.blog')}} </a> </li>
                            <li class="breadcrumb-item active">{{trans('app.edit')}}  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('blog.update',$blog[0]->ids)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('app.title')}}<span style="color:red;">*</span>:</label>
                                <input name="title" value="{{$blog[0]->title}}" type="text" class="form-control" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.englishtitle')}}<span style="color:red;">*</span>:</label>
                                <input name="englishtitle" value="{{$blog[1]->title}}" type="text" class="form-control" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.descreption')}}<span style="color:red;">*</span>:</label>
                                <textarea name="descreption" value="" class="form-control" rows="10"> {{$blog[0]->descreption}} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.englishdescreption')}}<span style="color:red;">*</span>:</label>
                                <textarea name="englishdescreption" class="form-control" rows="10"> {{$blog[1]->descreption}} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">{{trans('app.image')}}</label>
                                <input type="file" name="image"  class="form-control"   enctype="multipart/form-data"  >
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu">{{trans('app.edit')}}</button>
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