@extends('admin.layout')
@section('title','Reports')

@section('styles')
    <style>
        .dt-buttons{
            margin-top: 10px;
        }
        select[name="myTable_length"] {
            padding: 0;
            line-height: 10px;
        }
        .dataTables_length > label{
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors Session Reports </h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Reports</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">

                <h3 class="box-title m-b-0">Tutors Session Reports</h3>
                <hr>
                <div class="table-responsive">
                    <div class="col-md-10"></div>

                    <br>
                    <br>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Booked</th>
                            <th>Started</th>
                            <th>Completed</th>
                            <th>Missed</th>
                            <th>Pending</th>
                            <th>Rejected</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tutorList as $tutor)
                            <tr>
                                <td hidden>{{$tutor->get('id')}}</td>
                                <td>{{$tutor->get('firstName') ? $tutor->get('firstName') : 'N-A'}}</td>
                                <td>{{$tutor->get('lastName') ? $tutor->get('lastName') : 'N-A'}}</td>
                                <td>{{$tutor->get('booked')}}</td>
                                <td>{{$tutor->get('started')}}</td>
                                <td>{{$tutor->get('ended')}}</td>
                                <td>{{$tutor->get('expired')}}</td>
                                <td>{{$tutor->get('pending')}}</td>
                                <td>{{$tutor->get('reject')}}</td>
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
            let table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-8"B><"col-sm-4"fr>><"row"<"col-sm-10"><"col-sm-2"i>>t<"row"<"col-sm-2"l><"col-sm-10"p>>i',
                buttons: [
                    { extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        }  },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        } }
                ],
                "language": {
                    "info": "Total reports : _MAX_ ",
                }

            });

            console.log(table.rows().count());

            // Event listener to the two range filtering inputs to redraw on input
            $('#ratings').change(function() {
                table.draw();
            });
        });

    </script>
@stop
<style>
    .black-333{
        color: #333333;
    }
</style>
