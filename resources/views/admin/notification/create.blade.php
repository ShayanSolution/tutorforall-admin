@extends('admin.layout')
@section('title','create notification')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Create Notification</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Create Notification</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('notifications.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Title</label>
                        <div class="col-md-12">
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Message</label>
                        <div class="col-md-12">
                            <input type="text" name="message" class="form-control" placeholder="Message" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Description</label>
                        <div class="col-md-12">
                            <textarea type="text" name="description" class="form-control" placeholder="Description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Image</label>
                        <div class="col-md-12">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Excel/Csv</label>
                        <div class="col-md-12">
                            <input type="file" name="csv" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Send</button>
                    <a href="{{route('notifications.index')}}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
