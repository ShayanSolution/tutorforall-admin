@extends('admin.layout')
@section('title','Sessions')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Session List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Session List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Session List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Session ID</th>
                            <th>Student Name</th>
                            <th>Tutor Name</th>
                            <th>Class Name</th>
                            <th>Subject Name</th>
                            <th>Group Session</th>
                            <th>Group Members</th>
                            <th>Session Status</th>
                            <th>Duration</th>
                            <th>Session Location</th>
                            <th>Hourly Rate/RS</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>

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
            fetch_data();
            function fetch_data(filterDataArray = '')
            {
                let table = $('#myTable').DataTable({
                    dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-2"i><"col-sm-10"p>>',
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax : {
                        url :"{{ route($sessionStatus) }}",
                        data: {filterDataArray : filterDataArray},
                        complete : function (data) {
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'studentName', name: 'studentName'},
                        {data: 'tutorName', name: 'tutorName'},
                        {data: 'className', name: 'className'},
                        {data: 'subjectName', name: 'subjectName'},
                        {data: 'groupSession', name: 'groupSession'},
                        {data: 'group_members', name: 'group_members'},
                        {data: 'status', name: 'status'},
                        {data: 'duration', name: 'duration'},
                        {data: 'session_location', name: 'session_location'},
                        {data: 'hourly_rate', name: 'hourly_rate'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                    buttons: [
                        { extend: 'csv', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } },
                        { extend: 'excel', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } },
                        { extend: 'print', className: 'btn-md', exportOptions: {
                                columns: ['0','1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } }
                    ],
                    search: {
                        "regex": true
                    },
                    "bSort": true
                });
            }
        });
    </script>
@stop
