@extends('admin.layout')
@section('title','Tootar Terms and Conditions')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Terms and Conditions</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active"> Edit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('postTootarTC')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Content</label>
                        <div class="col-md-12">
                            <textarea class="summernote" name="contentText" >{{$termCond->content}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="white-box">
                <a type="button" class="fcbtn btn btn-info btn-outline btn-1d resetTootarTC">Send Terms and Conditions to All Tootar Users</a>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
@parent
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        $(".summernote").summernote({
            height: 500,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ul', 'paragraph', 'height' ] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });

        $(".resetTootarTC").click(function(ev){
            let userRoleId = 3;
            $.ajax({
                type: 'POST',
                url: '/admin/reset-term-condition',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {id:userRoleId,"_token": "{{ csrf_token() }}"},

                success: function (data) {
                    Swal.fire(
                        "Successfully Sent Terms and Conditions to All Tootar Users"
                    )
                },
                error: function (data) {
                    Swal.fire(
                        "Failed To Send Terms and Conditions to All Tootar Users"
                    )
                }
            });
        });
    });
</script>
@stop
