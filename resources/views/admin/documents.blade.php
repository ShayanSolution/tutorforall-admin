@extends('admin.layout')
@section('title','tutorsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Documents and Subjects List of {!!  $tutorDocuments[0]->user['firstName']." ".$tutorDocuments[0]->user['lastName']!!}</h4> </div>
            <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
{{--                    <li><a href="#">Admin</a></li>--}}
{{--                    <li class="active">Documents and Subjects List</li>--}}
                    <li><a class="btn btn-inverse waves-effect waves-light" style="color: white;" href="/admin/candidates">Back</a></li>
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
                        @foreach($tutorDocuments as $progSubDoc)
                            @if($progSubDoc->program->status != 2)
                            <tr>
                                <td>{!! $progSubDoc->program->name !!}</td>
                                <td>
                                    {!! $progSubDoc->subject->name !!}
                                </td>
                            </tr>
                            @endif
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
                        @foreach($tutorDocuments as $progSubDoc)
                            <tr>
                                <td>{{ $progSubDoc->program->name."(".$progSubDoc->subject->name.")" }}</td>
                                <td>
                                    {!! $progSubDoc->status !!}
                                </td>
                                <td>
                                    {!! $progSubDoc->showRejectionReason() !!}
                                    {{--
                                    {{--
                                        Showing show more option by calling showRejectionReason()
                                        if rejection reason increases from 20 characters
                                     --}}
                                </td>
                                <td>
                                    {{ $progSubDoc->verified_by }}
                                </td>
                                <td>
                                    {{ $progSubDoc->verified_at }}
                                </td>
                                <td>
                                    <a  href="{{'http://tutor4all-api.shayansolutions.com'.$progSubDoc->document->path}}"
                                        {{--href="/admin/documents/{{$document->id}}"--}}
{{--                                        name="{{$progSubDoc->document != null ? $progSubDoc->document->path: ''}}"--}}
                                        class="fcbtn btn btn-default btn-outline btn-1d downloadImage"
                                        target="_blank"
                                    >
                                        Download
                                    </a>
                                    <a type="button"
                                       class="fcbtn btn btn-info btn-outline btn-1d"
                                       data-target="#preview{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}"
                                       data-toggle="modal"
                                    >
                                        Preview
                                    </a>
                                    @if($progSubDoc->document != null)
                                    @if($progSubDoc->status == 'Pending')
                                        <a type="button"
                                           class="fcbtn btn btn-warning btn-outline btn-1d"
                                           data-target="#enterRejectionReason{{$progSubDoc->document->id}}"
                                           data-toggle="modal"
                                        >
                                            Reject
                                        </a>
                                        <a type="button"
                                           class="fcbtn btn btn-success btn-outline btn-1d"
                                           href="{{route('acceptDocument', $progSubDoc->id)}}"
                                        >
                                            Accept
                                        </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>

                            <div id="preview{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Document Preview</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{$progSubDoc->document != null ? 'http://tutor4all-api.shayansolutions.com'.$progSubDoc->document->path : ''}}" width="500">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="enterRejectionReason{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <form action="{{route('rejectDocument')}}" method="post">
                                            @csrf
                                            <input name="document_id" hidden value="{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}">
                                            <input name="prog_sub_id" hidden value="{{$progSubDoc != null ? $progSubDoc->id : ''}}">
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

                            <div id="showMore{{$progSubDoc != null ? $progSubDoc->id : ''}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Rejection Reason</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{$progSubDoc->rejection_reason}}</p>
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
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "bSort": false
            });

            $(".downloadImage").click(function () {
                var url = $(this).attr("name");

                alert("Image will open in new window. Right click and save as for download image. Will direct download in future");
            });
        });
    </script>
@stop
