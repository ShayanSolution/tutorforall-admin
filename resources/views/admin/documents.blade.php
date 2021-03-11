@extends('admin.layout')
@section('title','tutorsList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <?php
            $showarray = Config('app.api_url', 'www.test.com/');
            ?>
            <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Documents and Subjects List
                    of @if(!$tutorDocuments->isEmpty()){!!  $tutorDocuments[0]->user['firstName']." ".$tutorDocuments[0]->user['lastName']!!}@endif</h4>
            </div>
            <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    {{--                    <li><a href="#">Admin</a></li>--}}
                    {{--                    <li class="active">Documents and Subjects List</li>--}}
                    <? global $href; ?>
                    <? $href = "/zukerbend/candidates"?>
                    @foreach($tutorDocuments as $progSubDoc)
                        @if($progSubDoc->status != 'Pending')
                            <? $href = "/zukerbend/tutors/list"?>
                        @endif
                    @endforeach

                    <li><a class="btn btn-inverse waves-effect waves-light" style="color: white;"
                           href={{$href}}>Back</a></li>
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
                                    <td>{!! $progSubDoc->program?$progSubDoc->program->name:'N-A' !!}</td>
                                    <td>
                                        {!! $progSubDoc->subject?$progSubDoc->subject->name:'N-A' !!}
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
                            @if(!$progSubDoc->document == null)
                                <tr>
                                    <td>{{ $progSubDoc->program?$progSubDoc->program->name."(".$progSubDoc->subject->name.")":'N-A' }}</td>
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
                                        <a
                                            {{--                                        href="{{$showarray.$progSubDoc->document->path}}"--}}
                                            {{--href="/zukerbend/documents/{{$document->id}}"--}}
                                            name="{{$progSubDoc->document != null ? $showarray.$progSubDoc->document->path: ''}}"
                                            class="fcbtn btn btn-default btn-outline btn-1d downloadImage"
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
                                                   data-target="#enterRejectionReason{{$progSubDoc->id}}"
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

                                <div id="preview{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}"
                                     class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Document Preview</h4>
                                            </div>
                                            <div class="modal-body">
                                                @if($progSubDoc->document->document_type== "cnic_front" || $progSubDoc->document->document_type== "cnic_back")
                                                <p>
                                                    <span><b>CNIC/BForm #: </b>{{$progSubDoc->user->cnic_no}}</span>
                                                </p>
                                                <br>
                                                @endif
                                                <img
                                                    src="{{$progSubDoc->document != null ? $showarray.$progSubDoc->document->path : ''}}"
                                                    width="500">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="enterRejectionReason{{$progSubDoc->document!= null ? $progSubDoc->id : ''}}"
                                     class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <form action="{{route('rejectDocument')}}" method="post">
                                                @csrf
                                                <input name="document_id" hidden
                                                       value="{{$progSubDoc->document != null ? $progSubDoc->document->id : ''}}">
                                                <input name="prog_sub_id" hidden
                                                       value="{{$progSubDoc != null ? $progSubDoc->id : ''}}">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Rejection Reason</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label>Rejection Reason</label>
                                                    <p><textarea name="rejection_reason"
                                                                 class="form-control"></textarea></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="enterMasterRejectionReason{{$progSubDoc->document!= null ? $progSubDoc->user_id : ''}}"
                                     class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <form action="{{route('masterReject')}}" method="post">
                                                @csrf
                                                <input name="user_id" hidden
                                                       value="{{$progSubDoc->document != null ? $progSubDoc->document->tutor_id : ''}}">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Master Rejection Reason</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><textarea name="master_rejection_reason"
                                                                 class="form-control"></textarea></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="showMore{{$progSubDoc != null ? $progSubDoc->id : ''}}" class="modal fade"
                                     role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Rejection Reason</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$progSubDoc->rejection_reason}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="white-box">
                <h1 class="box-title m-b-0"><b>Master Reject</b></h1>
                <p><b>Note:</b> Master reject will delete user and it's related classes, subjects and documents permanently </p>
                <hr>
                <div class="table-responsive">
                    <a type="button"
                       class="fcbtn btn btn-danger btn-outline btn-1d"
                       data-target="#enterMasterRejectionReason{{$progSubDoc->user_id}}"
                       data-toggle="modal"
                    >
                        Master Reject
                    </a>
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
            var base_url = '{{url('/')}}';
            var _token = "{{csrf_token()}}";
            $(".downloadImage").click(function () {
                var url = $(this).attr("name");
                $.ajax({
                    url: base_url + '/zukerbend/download/document',
                    type: "POST",
                    data: {url_doc: url, _token: _token},
                    success: function (response) {
                        var imageUrl = response.url;
                        var a = $("<a>")
                            .attr("href", imageUrl)
                            .attr("download", "img.png")
                            .appendTo("body");

                        a[0].click();

                        a.remove();

                    }
                });
                // alert("Image will open in new window. Right click and save as for download image. Will direct download in future");
            });
        });
    </script>
@stop
