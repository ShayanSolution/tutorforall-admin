@extends('admin.layout')
@section('title','tutorsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">TutorsList</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('tutorAdd')}}">Add Tutor</a>
                </div>
                <h3 class="box-title m-b-0">Tutors List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Rating</th>
                            <th>Active</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tutors as $tutor)
                                <tr>
                                    <td>{{$tutor->email}}</td>
                                    <td>{{$tutor->phone}}</td>
                                    <td>{{round($tutor->rating->avg('rating'),1)}}</td>
                                    {{--<td>@if($tutor->is_active == 1) Yes @else No @endif</td>--}}
                                    <td><input type="checkbox" data-tutor-id="{{ $tutor->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($tutor->is_active == 1) checked @endif></td>
                                    <td><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="{{route('tutorProfile',$tutor->id)}}" alt="default">View</a></td>
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
        $('.js-switch').on('change.bootstrapSwitch', function(e) {
            var base_url = $(this).data('url');
            var tutor_id = $(this).attr("data-tutor-id");
            $.ajax({
                url:base_url+'/admin/changeTutorStatus',
                type: 'GET',
                data: { tutor_id :tutor_id, is_active: e.target.checked},
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