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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/subcategory')}}"> {{trans('app.subcategory')}} </a> </li>
                            <li class="breadcrumb-item active"> {{trans('app.edit')}}  </li>
                        </ol>
                    </div>
                </div>
                <div class="box box-primary">
                    <form action="{{route('subcategory.update',$subcategory[0]->ids)}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">الصنف<span style="color:red;">*</span>:</label>
                                <select class="form-control" name="categore_id">
                                    @for($i=0;$i<count($category);$i++)
                                        <option id="cat" name="cat"  <?php if( $category[$i]->categore_id == $subcategory[0]->categore_id) echo  "selected"; ?>
                                        value="{{$category[$i]->categore_id}}">{{$category[$i]->name}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name"> اسم القسم الفرعي  <span style="color:red;">*</span>:</label>
                                <input name="subcategory_name" type="text" value="{{$subcategory[0]->subcategory_name}}" class="form-control" id="name" placeholder="اسم القسم الفرعي ....." required />
                            </div>

                            <div class="form-group">
                                <label for="name">{{trans('app.name')}}<span style="color:red;">*</span>:</label>
                                <input name="subcategory_nameenglish"  value="{{$subcategory[1]->subcategory_name}}"  type="text" class="form-control" id="name" placeholder="اسم القسم الفرعي ....." required />
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