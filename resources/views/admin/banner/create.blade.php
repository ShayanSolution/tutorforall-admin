@extends('admin.layout')
@section('title','create banner')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Create Banner</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Create Banner</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('banners.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">HyperLink</label>
                        <div class="col-md-12">
                            <input type="url" name="url" class="form-control" placeholder="https://example.com" pattern="https://.*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Image</label>
                        <div class="col-md-12">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Csv</label>
                        <div class="col-md-12">
                            <input type="file" name="csv" class="form-control" accept=".csv" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Send</button>
                    <a href="{{route('banners.index')}}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
