@extends('admin.layout')
@section('title','tutorsList')
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
                                    <td>{{$session->duration}}</td>
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
    <script src="{{url('admin_assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin_assets/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
    <script src="{{url('admin_assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "bSort": false
            });
        });
    </script>
@stop
