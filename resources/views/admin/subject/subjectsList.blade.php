@extends('admin.layout')
@section('title','subjectsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Subject List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Subject List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('subjectAdd')}}">Add Subject</a>
                </div>
                <h3 class="box-title m-b-0">Subject List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Active</th>
                            <th>Program</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Program</th>
                            <th>Created</th>
                            <th>Action</th>
{{--                            <th>Delete</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)

                            <tr>
                                <td>{{$subject->name}}</td>
                                <td>@if($subject->status == 1) Yes @else No @endif</td>
                                <td>@if($subject->programme){{$subject->programme->name}}@else {{ 'No Programme available.' }} @endif</td>
                                <td>{{dateTimeConverter($subject->created_at)}}</td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-info btn-outline btn-1d" href="{{route('subjectEdit',$subject->id)}}">Edit</a>
                                    </div>
                                </td>
{{--                                <td>--}}
{{--                                    <div class="col-lg-4 col-sm-4 col-xs-4">--}}
{{--                                        <a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModalSubject{{$subject->id}}">Delete</a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                            <!-- delete modal content -->
{{--                            <div id="deleteModalSubject{{$subject->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog modal-confirm">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h4 class="modal-title">Delete</h4>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <p>Do you really want to delete this subject?</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>--}}
{{--                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('subjectDelete',$subject->id)}}" style="color: white">Delete</a>--}}
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
            var table = $('#myTable').DataTable( {
                dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
                buttons: [
                    { extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0','1', '2'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0','1', '2'],
                        } },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0','1', '2'],
                        } }
                ],
                "bSort": true,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]
            } );
            $("#myTable tfoot th").each( function ( i ) {

                if ($(this).text() !== '' ) {
                    var select = $('<select class="filter_search_subject"><option value="">All</option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $(this).val();

                            table.column( i )
                                .search( val ? '^'+$(this).val()+'$' : val, true, false )
                                .draw();
                        } );
                    table.column( i ).data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' );
                    } );
                }
            } );
        });
        $('.js-switch').on('change.bootstrapSwitch', function(e) {
            var base_url = $(this).data('url');
            var student_id = $(this).attr("data-student-id");
            $.ajax({
                url:base_url+'/admin/changeStudentDeserving',
                type: 'GET',
                data: { student_id :student_id, is_deserving: e.target.checked},
                success:function(response){
                    console.log(response);
                }
            });
        });
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
                var base_url = $(this).data('url');
            });

    </script>
@stop
