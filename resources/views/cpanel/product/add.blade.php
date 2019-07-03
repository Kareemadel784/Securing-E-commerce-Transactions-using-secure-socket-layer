@extends('layouts.cpanellayout')
@section('title')
    اضافه منتج جديد
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
                            <li class="breadcrumb-item"><a href="{{url('admin')}}">الرئيسيه</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/product')}}">المنتجات </a> </li>
                            <li class="breadcrumb-item active">اضافة </li>
                        </ol>
                    </div>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('product.store')}}" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card card-body col-md-6">
                            <div class="form-group">
                                <label for="name">{{trans('app.productname')}}<span style="color:red;">*</span>:</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="{{trans('app.productname')}} " required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.productnameenglish')}}<span style="color:red;">*</span>:</label>
                                <input name="productnameenglish" type="text" class="form-control" id="name" placeholder="{{trans('app.productnameenglish')}} " required />
                            </div>
                            <div class="form-group">
                                <label for="name"> {{trans('app.productdescreption')}} <span style="color:red;">*</span>:</label>
                                <input name="descreption" type="text" class="form-control" id="name" placeholder=" {{trans('app.productdescreption')}} " required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{trans('app.productdescreptionenglish')}} <span style="color:red;">*</span>:</label>
                                <input name="productdescreptionenglish" type="text" class="form-control" id="name" placeholder="{{trans('app.productdescreptionenglish')}} " required />
                            </div>
                            <div class="form-group">
                                <label for="name">  {{trans('app.productquentity')}}<span style="color:red;">*</span>: </label>
                                <input name="count" type="number" class="form-control" id="name" placeholder=" {{trans('app.productquentity')}}" required />
                            </div>
                            <div class="form-group">
                                <label for="name">   {{trans('app.productbuy')}}  <span style="color:red;">*</span>:</label>
                                <input name="pricebuy" type="text" class="form-control" id="name" placeholder="  {{trans('app.productbuy')}}  " required />
                            </div>
                            <div class="form-group">
                                <label for="name"> {{trans('app.productprice')}}  <span style="color:red;">*</span>:</label>
                                <input name="price" type="text" class="form-control" id="name" placeholder="{{trans('app.productprice')}}  " required />
                            </div>
                            <div class="form-group">
                                <label for="name"> {{trans('app.productdiscount')}} <span style="color:red;">% *</span>:</label>
                                <input name="offer" type="number" class="form-control" id="name" placeholder="{{trans('app.productdiscount')}}" required />
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 m-t-20">
                                    <select class="form-control" name="categore_id"  onchange="SubcategoryFunction(this.value)">
                                        <option id="cat"  selected>{{trans('app.cat')}} </option>
                                        @for($i=0;$i<count($category);$i++)
                                            <option id="cat" name="cat" value="{{$category[$i]->categore_id}}">{{$category[$i]->name}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-t-20" >
                                    <select class="form-control" style="display: none" name="subcategory_id" id="subcategor_id">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">{{trans('app.productimage')}}</label>
                                <input type="file"  name="image[]" multiple class="form-control"  enctype="multipart/form-data"   required>
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
@section('footer')
    <script>
        function SubcategoryFunction(val)
        {
            $.ajax({
                url: '{{url('admin/subcategoryincategory')}}'+'/'+val,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $.each(data, function(key, value) {
                        if(value['sub_name'] !='')
                        {
                            document.getElementById('subcategor_id').style.display="block";
                        }
                        else
                        {
                            document.getElementById('subcategor_id').style.display="none";
                        }
                    });
                    $('#subcategor_id').empty();
                    $('#subcategor_id').append('<option disabled selected >{{trans('app.subcategory')}} </option>');
                    $.each(data, function(key, value) {
                        $('#subcategor_id').append('<option value="'+ value['subcategore_id'] +'" name="subcategory_id" id="model">'+ value['subcategory_name'] +'</option>');
                    });
                },
                error: function (err) {
                    console.log(err);
                },
                complete: function (data) {
                    //   window.location.reload();
                }
            });
        }
    </script>
    @endsection