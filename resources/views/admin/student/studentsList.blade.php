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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th>Deserving</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)

                            <tr>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>@if($student->is_active == 1) Yes @else No @endif</td>
                                <td>
                                    <input type="checkbox" data-student-id="{{ $student->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($student->profile->is_deserving == 1) checked @endif>
                                </td>
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
            $('#myTable').DataTable( {
                "bSort": false
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