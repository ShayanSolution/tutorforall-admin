@extends('admin.layout')
@section('title','studentsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Students List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Students List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Students List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th>Deserving</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)

                            <tr>
                                <td>{{$student->firstName ? $student->firstName : 'N-A'}}</td>
                                <td>{{$student->lastName ? $student->lastName : 'N-A'}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td><input type="checkbox" data-student-id = "{{$student->id}}" class="js-switch-is_active" data-color="#99d683" @if($student->is_active == 1) checked @endif ></td>
                                <td><input type="checkbox" data-student-id = "{{$student->id}}"  class="js-switch" data-color="#99d683" @if($student->profile->is_deserving == 1) checked @endif></td>
                                <td><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModalStudent{{$student->id}}">Delete</a></td>
                            </tr>

                            <!-- delete modal content -->
                            <div id="deleteModalStudent{{$student->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete this student?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('studentDelete',$student->id)}}" style="color: white">Delete</a>
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
    <script src="{{url('admin_assets/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
    <script src="{{url('admin_assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable( {
                "bSort": false
            } );
            var base_url = '{{url('/')}}';
            var _token = "{{csrf_token()}}";
            $('.js-switch').on('change.bootstrapSwitch', function(e) {
                var student_id = $(this).attr("data-student-id");
                $.ajax({
                    url:base_url+'/admin/changeStudentDeserving',
                    type: 'POST',
                    data: { student_id :student_id, is_deserving: e.target.checked, _token:_token},
                    success:function(response){
                        console.log(response);
                    }
                });
            });
            $('.js-switch-is_active').on('change.bootstrapSwitch',function (e) {
                var student_id = $(this).attr("data-student-id");
                $.ajax({
                    url:base_url+'/admin/changeStudentStatus',
                    type:'POST',
                    data:{student_id: student_id, is_active:e.target.checked, _token:_token},
                    success:function (response) {
                        console.log(response);
                    }
                });
            });
        });


        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
            $('.js-switch-is_active').each(function () {
                new Switchery($(this)[0], $(this).data());
            });

    </script>
@stop