@extends('admin.layout')
@section('title','tutorsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Document Verification List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Candidates List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Candidates List</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                         </tr>
                        </thead>
                        <tbody>
                        @foreach($tutors as $tutor)
                            <tr>
                                <td>{{$tutor->email}}</td>
                                <td>{{$tutor->phone}}</td>
                                <td>
                                    <a type="button"
                                       class="fcbtn btn btn-warning btn-outline btn-1d"
                                       href="{{route('candidateDocuments', $tutor->id)}}"
                                    >
                                        Review Documents
                                    </a>
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
            $('#myTable').DataTable({
                "bSort": false
            });
        });
    </script>
@stop