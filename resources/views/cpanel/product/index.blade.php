@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.product')}}
@endsection

@section('header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">{{trans('app.home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('app.product')}}</li>
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
        @if (\Session::has('add'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong> تم الاضافة بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('pinding'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong> تم اخفاء المنتج بنجاح
                </div>
            </div>
        @endif
        @if (\Session::has('active'))
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <button type="button" class="close pull-left" data-dismiss="alert">x</button>
                    <strong>Success!</strong> تم اظهار المنتج بنجاح
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
                            <a href="{{route('product.create')}}">
                                <button class=" btn-success btn  btn-lg pull-left m-l-10">{{trans('app.add')}}</button>
                            </a><br><br>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table display table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th> {{trans('app.cat')}} </th>
                                    <th> {{trans('app.productname')}} </th>
                                    <th>{{trans('app.productdescreption')}}  </th>
                                    <th> {{trans('app.productquentity')}} </th>
                                    <th> {{trans('app.productbuy')}} </th>
                                    <th> {{trans('app.productprice')}} </th>
                                    <th> {{trans('app.productimage')}} </th>
                                    <th> {{trans('app.date')}}</th>
                                    <th>{{trans('app.controll')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $id=1; ?>
                                @for($i=0;$i<count($products);$i++)
                                <tr>
                                    <td>{{$id}}</td>
                                    <td>{{$products[$i]['category_name']}}
                                    </td>
                                    <td>{{$products[$i]['name']}}</td>
                                    <td>{{$products[$i]['descreption']}}</td>
                                    <td>{{$products[$i]['count']}}</td>
                                    <td>{{$products[$i]['pricebuy']}}</td>
                                    <td>{{$products[$i]['price']}}</td>
                                    <td>
                                        <a href="{{url('storage/app/'.$products[$i]['image'])}}" onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                            <img src="{{url('storage/app/'.$products[$i]['image'])}}" style="width: 150px; height: 90px;" alt="homepage" class="light-logo" />
                                        </a>
                                    </td>
                                    <td>{{$products[$i]['created_at']}}</td>
                                    <td>
                                        {{--@permission('تعديل حساب')--}}
                                        @if($products[$i]['pinding'] == 1)
                                        <a href="{{route('pindingproduct',$products[$i]['id'])}}" class="btn btn-primary"  title="الغاء تمييز المنتج " onclick="return confirm('هل تريد الغاء تمييز المنتج ')">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        @endif

                                        @if($products[$i]['pinding'] == 0)
                                            <a href="{{route('activeproduct',$products[$i]['id'])}}" class="btn btn-primary" title=" تمييز المنتج" onclick="return confirm('هل تريد تمييز المنتج ')">
                                                <i class="mdi mdi-eye-off"></i>
                                            </a>
                                        @endif
                                        <a href="{{route('product.edit',$products[$i]['id'])}}" class="btn btn-warning" >
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{--@endpermission--}}
                                        {{--@permission('حذف حساب')--}}
                                        <a><form action="{{route('product.destroy',$products[$i]['id'])}}" style="display: inline;" method="POST" accept-charset="utf-8">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button onclick="return confirm('Are you sure you want to Delete item?')" type="submit" class="btn btn-danger">
                                                    <i class="fas fa-archive"></i>
                                                </button>
                                            </form></a>
                                        {{--@endpermission--}}
                                    </td>
                                </tr>
                                    <?php $id+=1;?>
                                @endfor
                                </tbody>
                            </table>
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
    </script>
@endsection
