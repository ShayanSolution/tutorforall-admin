@extends('admin.layout')
@section('title','Reports')

@section('styles')
    <style>
        .dt-buttons {
            margin-top: 10px;
        }

        select[name="myTable_length"] {
            padding: 0;
            line-height: 10px;
        }

        .dataTables_length > label {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors Session Reports </h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Reports</li>
                </ol>
            </div>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $(document).ready(function () {
            let table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-2"i><"col-sm-10"p>>',
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('reports') }}",
                    complete: function (data) {
                        // Switchery
                        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                        $('.js-switch').each(function () {
                            new Switchery($(this)[0], $(this).data());
                            var base_url = $(this).data('url');
                        });

                        // Switchery
                        var elems = Array.prototype.slice.call(document.querySelectorAll('.is_approved_by_admin'));
                        $('.is_approved_by_admin').each(function () {
                            new Switchery($(this)[0], $(this).data());
                            var base_url = $(this).data('url');
                        });
                    }
                },
                columns: [
                    {data: 'firstName', name: 'firstName'},
                    {data: 'lastName', name: 'lastName'},
                    {data: 'booked', name: 'booked'},
                    {data: 'started', name: 'started'},
                    {data: 'completed', name: 'completed'},
                    {data: 'missed', name: 'missed'},
                    {data: 'pending', name: 'pending'},
                    {data: 'rejected', name: 'rejected'},
                ],
                buttons: [
                    {
                        extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        }
                    },
                    {
                        extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        }
                    },
                    {
                        extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                        }
                    }
                ],
                "bSort": false
            });

            // Event listener to the two range filtering inputs to redraw on input
            $('#ratings').change(function () {
                table.draw();
            });
        });


    </script>
@stop
<style>
    .black-333 {
        color: #333333;
    }
</style>
