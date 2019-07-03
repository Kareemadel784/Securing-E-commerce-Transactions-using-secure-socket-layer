@extends('layouts.cpanellayout')
@section('title')
    {{trans('app.captin')}}
@endsection
@section('header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">{{trans('app.home')}} </a></li>
                    <li class="breadcrumb-item active">{{trans('app.captin')}}</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <a href="{{route('captin.create')}}">
                                <button class=" btn-success btn  btn-lg pull-left m-l-10">{{trans('app.add')}} </button>
                            </a>
                            <br>
                            <br>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table display table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>{{trans('app.captinname')}} </th>
                                    <th>{{trans('app.telephone')}}</th>
                                    <th>{{trans('app.email')}} </th>
                                    <th>{{trans('app.controll')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $id=1;?>
                                @foreach($captin as $captins)
                                    <tr>
                                    <td>{{$id}}</td>
                                    <td>{{$captins->name}}</td>
                                    <td>{{$captins->telephone}}</td>
                                    <td>{{$captins->email}}</td>
                                    <td>
                                        {{--@permission('تعديل حساب')--}}
                                        <a href="{{route('captin.edit',$captins->id)}}" class="btn btn-warning" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{--@endpermission--}}
                                        {{--@permission('حذف حساب')--}}
                                        <a>
                                            <form action="{{route('captin.destroy',$captins->id)}}" style="display: inline;" method="POST" accept-charset="utf-8">
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
                                    <?php $id+=1;  ?>
                                @endforeach
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