@extends('admin.layout')
@section('title','tutorsAdd')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutor Add</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Tutor Add</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form class="form-material form-horizontal" action="{{route('tutorSave')}}" method="POST">
                    {{ csrf_field() }}
                    <!-- First Name -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">First Name</label>
                        <div class="col-md-12">
                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter first name" value="{{ old('firstName') }}" required>
                            @if ($errors->has('firstName'))
                                <span class="text-danger">{{ $errors->first('firstName') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Last Name -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">Last Name</label>
                        <div class="col-md-12">
                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter last name" value="{{ old('lastName') }}" required>
                            @if ($errors->has('lastName'))
                                <span class="text-danger">{{ $errors->first('lastName') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">Email</label>
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Phone # -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">Phone Number</label>
                        <div class="col-md-12">
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">Password</label>
                        <div class="col-md-12">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="example-text">Confirm Password</label>
                        <div class="col-md-12">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-12" for="bdate">Date of Birth</label>
                        <div class="col-md-12">
                            <input type="text" id="dob" name="dob" class="form-control mydatepicker" placeholder="enter your birth date" value="{{ old('dob') }}" required>
                            @if ($errors->has('dob'))
                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-12">Gender</label>
                        <div class="col-sm-12">
                            <select name="gender_id" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="1" {{ (old("gender_id") == 1 ? "selected":"") }} >Male</option>
                                <option value="2" {{ (old("gender_id") == 2 ? "selected":"") }} >Female</option>
                            </select>
                            @if ($errors->has('gender_id'))
                                <span class="text-danger">{{ $errors->first('gender_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script src="{{url('admin_assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#dob').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@stop