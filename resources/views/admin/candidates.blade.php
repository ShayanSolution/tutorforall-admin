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
                            <th>id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th style="text-align: center">Action</th>
                         </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($tutors as $tutor)--}}
{{--                            <tr>--}}
{{--                                <td>{{$tutor->firstName}}</td>--}}
{{--                                <td>{{$tutor->lastName}}</td>--}}
{{--                                <td>{{$tutor->profile ? ($tutor->profile->is_mentor ? 'Mentor' : 'Commercial' ) : 'N-A'}}</td>--}}
{{--                                <td>{{$tutor->email}}</td>--}}
{{--                                <td>{{$tutor->phone}}</td>--}}
{{--                                <td>{{dateTimeConverter($tutor->created_at)}}</td>--}}
{{--                                <td>--}}
{{--                                    <a type="button"--}}
{{--                                       class="fcbtn btn btn-warning btn-outline btn-1d"--}}
{{--                                       href="{{route('candidateDocuments', $tutor->id)}}"--}}
{{--                                    >--}}
{{--                                        Review Documents--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
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
            let table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
                processing: true,
                serverSide: true,
                ajax : {
                    url : "{{ route('candidates') }}",
                    complete : function (data) {
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
                    {data: 'id', name: 'id'},
                    {data: 'firstName', name: 'firstName'},
                    {data: 'lastName', name: 'lastName'},
                    {data: 'type', name: 'type'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'documents', name: 'documents'},
                ],
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "orderable": false,
                        "targets": 8
                    }
                ],
                buttons: [
                    { extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4'],
                        }  },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0', '1', '2', '3', '4'],
                        } }
                ],
                search: {
                    "regex": true
                },
                "bSort": true
            });

        });
    </script>
@stop
