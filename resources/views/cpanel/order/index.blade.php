@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.order')}}
@endsection

@section('header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">  {{trans('app.order')}}</a></li>
                    <li class="breadcrumb-item active">  {{trans('app.sendorder')}} </li>
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
                        <div class="">
                            <a href="{{route('order.create')}}">
                                <button class=" btn-success btn  btn-lg pull-left m-l-10">اضافه بيانات جديده </button>
                            </a><br><br>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="example23" class="table display table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>  {{trans('app.id')}}</th>
                                    <th>   {{trans('app.order')}}</th>
                                    <th>  {{trans('app.client')}} </th>
                                    <th>   {{trans('app.telephone')}} </th>
                                    <th>   {{trans('app.orderprice')}}</th>
                                    <th>   {{trans('app.orderdetials')}}  </th>
                                    <th>   {{trans('app.date')}}</th>
                                    <th>  {{trans('app.controll')}}</th>
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
                                <form action="{{url('admin/acceptorder')}}"  method="POST" id="myform">
                                    {{ csrf_field () }}
                                    <input onclick="return confirm('هل انت متاكد من قبول الطلبات المحدده  ؟');"
                                           type="submit" style="float: right;" class="btn btn-success pull-left" value="قبول الطلبات المحدده"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{url('resources/assets/plugins/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        // function onesignal()
        // {
        //   OneSignal.sendSelfNotification(
        //   /* Title (defaults if unset) */
        //   "OneSignal Web Push Notification",
        //   /* Message (defaults if unset) */
        //   "Action buttons increase the ways your users can interact with your notification.",
        //    /* URL (defaults if unset) */
        //   'https://example.com/?_osp=do_not_open',
        //   /* Icon */
        //   'https://onesignal.com/images/notification_logo.png',
        //   {
        //     /* Additional data hash */
        //     notificationType: 'news-feature'
        //   },
        //   [{ /* Buttons */
        //     /* Choose any unique identifier for your button. The ID of the clicked button is passed to you so you can identify which button is clicked */
        //     id: 'like-button',
        //     /* The text the button should display. Supports emojis. */
        //     text: 'Like',
        //     /* A valid publicly reachable URL to an icon. Keep this small because it's downloaded on each notification display. */
        //     icon: 'http://i.imgur.com/N8SN8ZS.png',
        //     /* The URL to open when this action button is clicked. See the sections below for special URLs that prevent opening any window. */
        //     url: 'http://safetysouq.com/admin/order'
        //   },
        //   {
        //     id: 'read-more-button',
        //     text: 'Read more',
        //     icon: 'http://i.imgur.com/MIxJp1L.png',
        //     url: 'http://safetysouq.com/admin/order'
        //   }]
        // );
        // }
    </script>
@endsection
