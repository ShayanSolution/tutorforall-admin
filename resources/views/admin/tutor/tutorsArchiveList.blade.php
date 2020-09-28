@extends('admin.layout')
@section('title','tutorsArchiveList')

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
                <h4 class="page-title">Tutors List ({{$mentorOrCommercial}})</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Tutors Archive List</li>
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
                    <div class="col-md-10"></div>

                    <br>
                    <br>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Rating</th>
                            <th>Created</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tutors as $tutor)
                                <tr>
                                    <td hidden>{{$tutor->id}}</td>
                                    <td>{{$tutor->firstName ? $tutor->firstName : 'N-A'}}</td>
                                    <td>{{$tutor->lastName ? $tutor->lastName : 'N-A'}}</td>
                                    <td>{{$tutor->email}}</td>
                                    <td>{{$tutor->phone}}</td>
                                    <td>{{round($tutor->rating->avg('rating'),1)}}</td>
                                    <td>{{dateTimeConverter($tutor->created_at)}}</td>
                                    <td>{{$tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login)}}</td>

                                    <td><a type="button" class="fcbtn btn btn-info btn-outline btn-1d"  data-toggle="modal" data-target="#restoreModaltutor{{$tutor->id}}">Restore</a></td>
                                </tr>

                                <!-- delete modal content -->
                                <div id="restoreModaltutor{{$tutor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Restore</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to restore this tutor?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <a type="button" class="fcbtn btn btn-info btn-1d" href="{{route('tutorRestore',$tutor->id)}}" style="color: white">Restore</a>
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
    <script>



        $(document).ready(function () {
            let table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
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
                "bSort": true
            });

            // Event listener to the two range filtering inputs to redraw on input
            $('#ratings').change(function() {
                table.draw();
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

        $('.is_approved_by_admin').on('change.bootstrapSwitch', function(e) {
            var base_url = $(this).data('url');
            var tutor_id = $(this).attr("data-tutor-id");
            $.ajax({
                url:base_url+'/admin/changeTutorApprovedStatus',
                type: 'GET',
                data: { tutor_id :tutor_id, is_approved: e.target.checked},
                success:function(response){
                    console.log(response);
                }
            });
        });
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.is_approved_by_admin'));
        $('.is_approved_by_admin').each(function () {
            new Switchery($(this)[0], $(this).data());
            var base_url = $(this).data('url');
        });
    </script>
@stop
<style>
    .black-333{
        color: #333333;
    }
</style>
