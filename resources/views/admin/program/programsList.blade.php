@extends('admin.layout')
@section('title','programsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Classes List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Classes List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('programAdd')}}">Add Class</a>
                </div>
                <h3 class="box-title m-b-0">Classes List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
{{--                            <th></th>--}}
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Created</th>
                            <th style="padding-left: 90px">Action</th>
{{--                            <th>Subjects</th>--}}
{{--                            <th>Edit</th>--}}
{{--                            <th>Delete</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($programs as $program)

                            <tr>
                                <td>{{$program->name}}</td>
                                <td>@if($program->status == 1) Yes @else No @endif</td>
                                <td>{{dateTimeConverter($program->created_at)}}</td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4" style="margin-right: 5px">
                                        <a type="button" class="fcbtn btn btn-warning btn-outline btn-1d"  alt="default" data-toggle="modal" data-target="#myModal{{$program->id}}" >Subjects</a>
                                    </div>
{{--                                </td>--}}
{{--                                <td>--}}
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-info btn-outline btn-1d" href="{{route('programEdit',$program->id)}}">Edit</a>
                                    </div>
                                </td>
{{--                                <td>--}}
{{--                                    <div class="col-lg-4 col-sm-4 col-xs-4">--}}
{{--                                        <a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModal{{$program->id}}">Delete</a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                            <!-- sample modal content -->
                            <div id="myModal{{$program->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Subjects</h4> </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                @if (count($program->subjects)>0)
                                                @foreach($program->subjects as $subject)
                                                    <li class="list-group-item">{{ $subject->name }}</li>
                                                @endforeach
                                                    @else
                                                    {{'No Subjects Available'}}
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- delete modal content -->
{{--                            <div id="deleteModal{{$program->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog modal-confirm">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h4 class="modal-title">Delete</h4>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <p>Do you really want to delete this class?</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>--}}
{{--                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('programDelete',$program->id)}}" style="color: white">Delete</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.modal-dialog -->--}}
{{--                            </div>--}}
                            <!-- /.modal -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascripts')
    @parent
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
                buttons: [
                    { extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0','1'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0','1'],
                        } },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0','1'],
                        } }
                ],
                "bSort": true,
                "columnDefs": [
                    { "orderable": false, "targets": 3 }
                ]
            });
            $("#myTable tfoot th").each( function ( i ) {

                if ($(this).text() !== '' ) {
                    var isActiveColumn = (($(this).text() == 'Status') ? true : false);
                    var name = 'Program';
                    if($(this).text() == 'Active')
                        var name = 'All';
                    var select = $('<select class="filter_search"><option value="">'+name+'</option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $(this).val();

                            table.column( i )
                                .search( val ? '^'+$(this).val()+'$' : val, true, false )
                                .draw();
                        } );

                    // Get the Status values a specific way since the status is a anchor/image
                    if (isActiveColumn) {
                        var activeItems = [];

                        /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
                        table.column( i ).nodes().to$().each( function(d, j){
                            var thisStatus = $(j).attr("data-filter");
                            if($.inArray(thisStatus, activeItems) === -1) activeItems.push(thisStatus);
                        } );

                        activeItems.sort();

                        $.each( activeItems, function(i, item){
                            select.append( '<option value="'+item+'">'+item+'</option>' );
                        });

                    }
                    // All other non-Status columns (like the example)
                    else {
                        // alert("here");
                        table.column( i ).data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' );
                        } );
                    }

                }
            } );
        });
    </script>
@stop
