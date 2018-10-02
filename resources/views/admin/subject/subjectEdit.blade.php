@extends('admin.layout')
@section('title','programEdit')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Subject Edit</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Subject Edit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('subjectUpdate',$subject->id)}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-sm-12">Program</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="program" required>
                                <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}" @if ($program->id == $subject->programme_id) selected @endif>{{$program->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Name</label>
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Enter subject name" value="{{$subject->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Active</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" @if($subject->status == 1) selected @endif>YES</option>
                                <option value="0" @if($subject->status == 0) selected @endif>No</option>
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
@stop