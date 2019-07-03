@extends('layouts.cpanellayout')
@section('title')
    تعديل قاعده
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
                            <li class="breadcrumb-item"><a href="{{url('admin/role')}}">القواعد </a> </li>
                            <li class="breadcrumb-item active">تعديل  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('role.update',$role->id)}}" method="post" role="form" accept-charset="utf-8">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name"> الاسم <span style="color:red;">*</span>:</label>
                                <input name="name" type="text" class="form-control" value="{{$role->name}}" id="name" placeholder="" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="display_name"> ضع اسم <span style="color:red;">*</span>:</label>
                                <input name="display_name" type="text" class="form-control" value="{{$role->display_name}}" id="display_name" placeholder="" required="required"/>
                            </div>

                            <div class="form-group">
                                <label for="description"> الوصف <span style="color:red;">*</span>:</label>
                                <input name="description" type="text" class="form-control" value="{{$role->description}}" id="description" placeholder="" required="required"/>
                            </div>

                            <div class="form-group">
                                <label for="name"> المسموح به <span style="color:red;">*</span>:</label>
                                @foreach($permissions as $permission)
                                    <input  name="permission[]" style="margin-left: 10px; opacity:2;    position: inherit;" {{in_array($permission->id,$role_permissions)? "checked":""}} value="{{$permission->id}}" type="checkbox" id="" /> {{$permission->name}}
                                @endforeach
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

<script src="admin/tinymce/js/tinymce/tinymce.min.js"></script>
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