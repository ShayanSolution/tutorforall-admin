@extends('admin.layout')
@section('title','programEdit')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Category Edit</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Category Edit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('categoryUpdate',$category->id)}}">
                    {{csrf_field()}}
                    <!-- Name -->
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Enter category name" required value="{{$category->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Percentage</label>
                        <div class="col-md-12">
                            <input type="text" name="percentage" class="form-control" value="{{$category->percentage}}" placeholder="Enter percentage value for this category" required>
                        </div>
                    </div>

                    <!-- /Name -->
                    <!-- Active Status -->
                    <div class="form-group">
                        <label class="col-sm-12">Active</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" @if ($category->status == 1) selected @endif>YES</option>
                                <option value="0" @if ($category->status == 0) selected @endif>No</option>
                            </select>
                        </div>
                    </div>

                    <!-- /Active Status -->
                    <!-- Hourly Rate -->
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-12" for="example-text">Hourly Rate</label>--}}
                        {{--<div class="col-md-12">--}}
                            {{--<input type="number" name="hourly_rate" class="form-control" placeholder="Enter hourly rate" required value="{{$category->packages ? $category->packages->hourly_rate : ''}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /Hourly Rate -->--}}
                    {{--<!-- Extra % for group of two -->--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-12" for="example-text">Extra % for group of two</label>--}}
                        {{--<div class="col-md-12">--}}
                            {{--<input type="number" name="extra_percentage_for_group_of_two" class="form-control" placeholder="Enter extra % for group of two" required value="{{$category->packages ? $category->packages->extra_percentage_for_group_of_two :  ''}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /Extra % for group of two -->--}}
                    {{--<!-- Extra % for group of three -->--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-12" for="example-text">Extra % for group of three</label>--}}
                        {{--<div class="col-md-12">--}}
                            {{--<input type="number" name="extra_percentage_for_group_of_three" class="form-control" placeholder="Enter extra % for group of three" required value="{{$category->packages ? $category->packages->extra_percentage_for_group_of_three : ''}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /Extra % for group of three -->--}}
                    {{--<!-- Extra % for group of three -->--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-md-12" for="example-text">Extra % for group of four</label>--}}
                        {{--<div class="col-md-12">--}}
                            {{--<input type="number" name="extra_percentage_for_group_of_four" class="form-control" placeholder="Enter extra % for group of four" required value="{{$category->packages ? $category->packages->extra_percentage_for_group_of_four : ''}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <!-- /Extra % for group of three -->
                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
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