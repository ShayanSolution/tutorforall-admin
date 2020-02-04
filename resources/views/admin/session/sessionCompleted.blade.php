@extends('admin.layout')
@section('title','Completed Sessions')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Completed Session List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Completed Session List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Completed Session List Details</h3>
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
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>{{$session->id}}</td>
                                    <td>{{$session->student ? $session->student->firstName." ". $session->student->lastName: 'N-A'}}</td>
                                    <td>{{$session->tutor ? $session->tutor->firstName." ". $session->tutor->lastName: 'N-A'}}</td>
                                    <td>{{$session->class ? $session->class->name : 'N-A'}}</td>
                                    <td>{{$session->subject ? $session->subject->name : 'N-A'}}</td>
                                    <td>{{$session->is_group == 0 ? 'No' : ' Yes'}}</td>
                                    <td>{{$session->group_members}}</td>
                                    <td>{{$session->status}}</td>
                                    <td>{{ ($session->duration == "") ? "" : \Carbon\Carbon::parse($session->duration)->format('H:i:s')}}</td>
                                    <td style="width: 20%">{{$session->session_location}}</td>
                                    <td>{{$session->hourly_rate}}</td>

                                </tr>
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
            $('#myTable').DataTable({
                dom: '<"row"<"col-sm-8"B><"col-sm-4"fr>>t<"row"<"col-sm-2"l><"col-sm-10"p>>',
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
                "bSort": false
            });
        });
    </script>
@stop
