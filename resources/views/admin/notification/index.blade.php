@extends('admin.layout')
@section('title','notificationsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Notifications List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Notifications List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('notifications.create')}}">Create notification</a>
                </div>
                <h3 class="box-title m-b-0">Notifications List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Descriptions</th>
                            <th>Created By</th>
                            <th>Send To</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($programs as $program)--}}
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
{{--                        @endforeach--}}
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
                            columns: ['0', '1', '2', '3', '4'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0','1', '2', '3', '4'],
                        } },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0','1', '2', '3', '4'],
                        } }
                ],
                "bSort": false
            });
        });
    </script>
@stop
