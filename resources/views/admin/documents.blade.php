@extends('admin.layout')
@section('title','tutorsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Documents and Subjects List of {{$tutor->fullName}}</h4> </div>
            <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Documents and Subjects List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Subjects List</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Class</th>
                            <th>Subject</th>
                         </tr>
                        </thead>
                        <tbody>
                        @foreach($tutor->program_subject as $program_subject)
                            <tr>
                                <td>{{ $program_subject->program }}</td>
                                <td>
                                    {!! $program_subject->subject !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="white-box">
                <h3 class="box-title m-b-0">Documents List</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Rejection Reason</th>
                            <th>Verified By</th>
                            <th>Verified At</th>
                            <th>Action</th>
                         </tr>
                        </thead>
                        <tbody>
                        @foreach($tutor->documents as $document)
                            <tr>
                                <td>{{ $document->title }}</td>
                                <td>
                                    {!! $document->status !!}
                                </td>
                                <td>
                                    {!! $document->showRejectionReason() !!}
                                    {{--
                                        Showing show more option by calling showRejectionReason()
                                        if rejection reason increases from 20 characters
                                     --}}
                                </td>
                                <td>
                                    {{ $document->verified_by }}
                                </td>
                                <td>
                                    {{ $document->verified_at }}
                                </td>
                                <td>
                                    <a  href="/admin/documents/{{$document->path}}"
                                        class="fcbtn btn btn-default btn-outline btn-1d"
                                        download
                                    >
                                        Download
                                    </a>
                                    <a type="button"
                                       class="fcbtn btn btn-info btn-outline btn-1d"
                                       data-target="#preview{{$document->id}}"
                                       data-toggle="modal"
                                    >
                                        Preview
                                    </a>
                                    @if($document->status == 'Pending')
                                        <a type="button"
                                           class="fcbtn btn btn-warning btn-outline btn-1d"
                                           data-target="#enterRejectionReason{{$document->id}}"
                                           data-toggle="modal"
                                        >
                                            Reject
                                        </a>
                                        <a type="button"
                                           class="fcbtn btn btn-success btn-outline btn-1d"
                                           href="{{route('acceptDocument', $document->id)}}"
                                        >
                                            Accept
                                        </a>
                                    @endif
                                </td>
                            </tr>

                            <div id="preview{{$document->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Document Preview</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{$document->path}}" width="500">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="enterRejectionReason{{$document->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <form action="{{route('rejectDocument')}}" method="post">
                                            @csrf
                                            <input name="document_id" hidden value="{{$document->id}}">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Rejection Reason</h4>
                                            </div>
                                            <div class="modal-body">
                                                <label>Rejection Reason</label>
                                                <p><textarea name="rejection_reason" class="form-control"></textarea></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="showMore{{$document->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Rejection Reason</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{$document->rejection_reason}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
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