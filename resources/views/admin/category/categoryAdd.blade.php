@extends('admin.layout')
@section('title','classesAdd')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Category Add</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Category Add</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('categorySave')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Enter class name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Percentage</label>
                        <div class="col-md-12">
                            <input type="number" name="percentage" class="form-control percentage" placeholder="Enter percentage value for this category" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Active</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1">YES</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                    <a href="{{route('programsList')}}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    {{--<script src="{{url('admin_assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>--}}
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#myTable').DataTable();--}}
        {{--});--}}
    {{--</script>--}}
@stop