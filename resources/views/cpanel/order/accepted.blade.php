@extends('layouts.cpanellayout')
@section('title')
كل  الطلبات
@endsection

@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">كل الطلبات المرسله </li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
                <div class="d-flex m-t-10 justify-content-end">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @if (\Session::has('acceptedorder'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong> تم قبول الطلب بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('update'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong> تم تعديل بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('delete'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong>  تم الحذف بنجاح
                </div>
            </div>
        @endif
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive m-t-40">
                            <table id="example" class="display" style="width:100%">
                                  <thead>
                                <tr>
                                    <th>م</th>
                                    <th>تحديد الاوردر</th>
                                    <th>اسم صاحب الاوردر </th>
                                    <th>رقم التليفون </th>
                                    <th>سعر الاوردر</th>
                                    <th>تفاصيل الاوردار  </th>
                                    <th> التاريخ</th>
                                    <th>التحكم</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $id=1; ?>
                                @for($i=0;$i<count($allsendorder);$i++)
                                <tr>
                                    <td>{{$id}}</td>
                                    <td>
                                        <input type="checkbox" style="width: 40px;height: 40px; position: initial;right: -9999px;opacity: 01;" id="edit-node-types-article" form="myform" name="cheackbox[]"
                                               value="{{$allsendorder[$i]['id']}}">
                                    </td>
                                    <td>{{$allsendorder[$i]['client_name']}}</td>
                                    <td>{{$allsendorder[$i]['client_telephone']}}</td>
                                    <td>{{$allsendorder[$i]['totalprice']}}</td>
                                    <td>
                                        @foreach($allsendorder[$i]['product'] as $product)
                                            <span> اسم المنتج المطلوب : {{$product->name}} - </span>الكميه <span>{{$product->quentety}}  </span> <br>
                                            @endforeach
                                    </td>
                                    <td>{{$allsendorder[$i]['created_at']}}</td>

                                    <td>
                                        <a href="{{route('order.show',$allsendorder[$i]['id'])}}" class="btn btn-primary" title="عرض تفاصيل الطلب " onclick="return confirm('هل انت متاكد من عرض تفاصيل الطلب؟ ')">
                                            <i class="fas fa-chevron-circle-right"></i>
                                        </a>
                                        {{--@permission('حذف حساب')--}}
                                        <a><form action="{{route('order.destroy',$allsendorder[$i]['id'])}}" style="display: inline;" method="POST" accept-charset="utf-8">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button onclick="return confirm('Are you sure you want to Delete item?')" type="submit" class="btn btn-danger">
                                                    <i class="fas fa-archive"></i>
                                                </button>
                                            </form>
                                        </a>
                                        {{--@endpermission--}}
                                    </td>
                                </tr>
                                    <?php $id+=1;?>
                                @endfor
                                </tbody>
                            </table>
                            <div class="form-group" style=" margin: 50px;">
                                <form action="{{url('admin/inwayorder')}}"  method="POST" id="myform">
                                    {{ csrf_field () }}
                                    <input onclick="return confirm('هل انت متاكد من قبول الطلبات المحدده  ؟');"
                                           type="submit" style="float: right;" class="btn btn-success pull-left" value="قبول الطلبات المحدده"/>
                                </form>
                                {{--<a href="{{route('collectorder')}}" class="btn btn-primary" title="  عرض تجميعه الطلبات"--}}
                                        {{--onclick="return confirm('هل انت متاكد من عرض تفاصيل الطلب؟ ')">--}}
                                      {{--عرض تجميعه الطلبات--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script src=" https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js "></script>
<script src=" https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js "></script>

    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              {
                  extend: 'print',
                  text: 'Print all',
                  exportOptions: {
                      modifier: {
                          selected: null
                      }
                  }
              },
              {
                  extend: 'print',
                  text: 'Print selected'
              }
          ],
          select: true
      } );
      } );
    </script>
@endsection
