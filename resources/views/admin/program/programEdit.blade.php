@extends('admin.layout')
@section('title','programEdit')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Class Edit</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Class Edit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('programUpdate',$program->id)}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Enter program name" required value="{{$program->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="note">Note</label>
                        <div class="col-md-12">
                            <textarea type="text" name="note" class="form-control" rows="2" placeholder="Enter note (At Max 50 words)" maxlength="50" required>{{$program->note}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Active</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" @if ($program->status == 1) selected @endif>YES</option>
                                <option value="0" @if ($program->status == 0) selected @endif>No</option>
                            </select>
                        </div>
                    </div>
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
