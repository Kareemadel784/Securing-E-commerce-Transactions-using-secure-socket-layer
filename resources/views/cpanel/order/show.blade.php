@extends('layouts.cpanellayout')
@section('title')
كل  الطلبات
@endsection

@section('header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Table Data table</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/order')}}">كل الطلبات المرسله</a></li>
                    <li class="breadcrumb-item active">تفاصيل الطلب</li>
                </ol>
            </div>
        </div>


            <div class="container-fluid">

            @if($order[0]->stutas == 0)
                <div class="form-group" style=" margin: 50px;">
                    <form action="{{url('admin/acceptorder')}}"  method="POST" id="myform">
                        {{ csrf_field () }}
                        <input type="checkbox" id="edit-node-types-article" checked form="myform" name="cheackbox[]"
                               value="{{$order[0]->id}}">
                        <input onclick="return confirm('هل انت متاكد من قبول الطلبات المحدده  ؟');"
                               type="submit" style="float: right;" class="btn btn-success pull-left" value="قبول الطلب "/>
                    </form>
                </div>
                @endif
                <a href="{{url('/admin/prinorder',$order[0]->id)}}" class="btn btn-primary" style="margin-right:25px">print</a>

                <br>
                <br>
                <br>
                <br>
                <div class="row el-element-overlay">
                    <div class="col-md-12">
                        <h4 class="card-title">اسم صاحب الطلب : <span>{{$order[0]->client_name}}</span></h4>
                        <h4 class="card-title">  رقم التليفون  : <span>{{$order[0]->client_telephone}}</span></h4>
                        <h4 class="card-title">   العنوان التفصيلي   : <span>{{$order[0]->address}} </h4>
                        <h2 class="card-subtitle m-b-20 text-muted">التكلفه شامله الشحن تساوي :  <code>{{$order[0]->totalprice}}</code></h2> </div>
                    @for($i=0;$i<count($products);$i++)
                     <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1">
                                    <h1>{{$products[$i]['name']}}</h1>
                                    <a href="{{url('storage/app/'.$products[$i]['image'])}}" style="display: block" id="images"
                                       onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                        <img src="{{url('storage/app/'.$products[$i]['image'])}}" style="width: 350px; height: 300px" alt="user" />
                                    </a>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title"> التاريخ : </h3> <small>{{$products[$i]['created_at']}}</small>
                                    <h3 class="box-title">الكميه المطلوبه: </h3> <small>{{$products[$i]['quentety']}}</small>
                                    <br/> </div>
                            </div>
                        </div>
                    </div>
                    @endfor


                </div>
            </div>
    </div>
@endsection
@section('footer')
    <script>
        function myFunction() {
            document.getElementById('images').style.display="none";
            window.print();
        }
    </script>
@endsection
