@extends('admin.layout')
@section('title','settings')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Application Settings</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Application Settings</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <form method="post" class="form-material form-horizontal" action="{{route('saveSettings')}}" autocomplete="off">
                {{csrf_field()}}
                @foreach($newSettingsArray as $key=>$settings)
                    <div class="white-box">
                    @if($key !== "Discount")
                    <h2>{{$key}}</h2>
                    @else
                    <h2>{{"Discount only will applied on go to tutor"}}</h2>
                    @endif
                    @foreach($settings as $setting)
                        <div class="form-group">
                            <label class="col-md-12" for="example-text">{{$setting->label}}</label>
                            <div class="col-md-12">
                                @if($setting->slug !== 'peak-factor-on-off' && $setting->slug !== 'percent-discount-on-go-to-tutor-status')
                                    <input type="text" name="{{$setting->slug}}" class="form-control" placeholder="Enter Number Of Students" value="{{old($setting->slug) ? old($setting->slug) : $setting->value. ' '.$setting->after_value }}">
                                @else
                                    <select name="{{$setting->slug}}" class="form-control">
                                        <option value="1" {{$setting->value == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{$setting->value == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                <a href="{{route('programsList')}}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
