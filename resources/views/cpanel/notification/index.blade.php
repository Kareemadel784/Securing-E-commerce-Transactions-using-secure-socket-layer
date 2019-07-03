@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.notification')}}
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
          @if (\Session::has('send'))
              <div class="col-xs-12">
                  <div class="alert alert-success">
                      <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                      <strong>Success!</strong> تم ارسال الاشعار بنجاح
                  </div>
              </div>
          @endif
            <!-- left column -->
            <div class="col-md-12">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسيه</a></li>
                            <li class="breadcrumb-item active">ارسال اشعار </li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('sendnotification')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data"  >
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">ارسال الاشعار<span style="color:red;">*</span>:</label>
                                <input name="message" type="text" class="form-control" id="name" placeholder=" نص الاشعار" required />
                            </div>
                            <div class="form-group m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pu">ارسال</button>
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
