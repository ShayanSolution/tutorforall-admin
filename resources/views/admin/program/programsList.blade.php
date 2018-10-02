@extends('admin.layout')
@section('title','programsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Programs List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">ProgramsList</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-danger" href="{{route('programAdd')}}">Add Program</a>
                </div>
                <h3 class="box-title m-b-0">Programs List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($programs as $program)

                            <tr>
                                <td>{{$program->name}}</td>
                                <td>@if($program->status == 1) Yes @else No @endif</td>
                                {{--<td>--}}
                                    {{--<input type="checkbox" data-student-id="{{ $student->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($student->profile->is_deserving == 1) checked @endif>--}}
                                {{--</td>--}}
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
    {{--<script src="{{url('admin_assets/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>--}}
    {{--<script src="{{url('admin_assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "bSort": false
            });
        });
        {{--$('.js-switch').on('change.bootstrapSwitch', function(e) {--}}
            {{--var base_url = $(this).data('url');--}}
            {{--var student_id = $(this).attr("data-student-id");--}}
            {{--$.ajax({--}}
                {{--url:base_url+'/admin/changeStudentDeserving',--}}
                {{--type: 'GET',--}}
                {{--data: { student_id :student_id, is_deserving: e.target.checked},--}}
                {{--success:function(response){--}}
                    {{--console.log(response);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
        {{--// Switchery--}}
        {{--var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));--}}
            {{--$('.js-switch').each(function () {--}}
                {{--new Switchery($(this)[0], $(this).data());--}}
                {{--var base_url = $(this).data('url');--}}
            {{--});--}}

    // </script>
@stop