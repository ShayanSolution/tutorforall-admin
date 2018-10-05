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
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Subjects</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($programs as $program)

                            <tr>
                                <td>{{$program->name}}</td>
                                <td>@if($program->status == 1) Yes @else No @endif</td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-warning btn-outline btn-1d"  alt="default" data-toggle="modal" data-target="#myModal{{$program->id}}" >View</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-info btn-outline btn-1d" href="{{route('programEdit',$program->id)}}">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModal{{$program->id}}">Delete</a>
                                    </div>
                                </td>
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
                                                @foreach($program->subjects as $subject)
                                                    <li class="list-group-item">{{ $subject->name }}</li>
                                                @endforeach
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
                            <div id="deleteModal{{$program->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete this class?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('programDelete',$program->id)}}" style="color: white">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
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
    <script src="{{url('admin_assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "bSort": false
            });
        });
    </script>
@stop