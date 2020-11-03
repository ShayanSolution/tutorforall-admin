@extends('admin.layout')
@section('title','tutorsEdit')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <?php
            $showarray = Config('app.api_url', 'www.test.com/');
            ?>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutor Edit</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Tutor Edit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Edit Tutor Information</h3>
                    <form id="form" class="form-horizontal" action="{{route('tutorUpdate',$user->id)}}" method="POST"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="wizard-content">
                            <div class="wizard-pane active" role="tabpanel">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter first name" value="@if ($user->firstName != '') {{$user->firstName}} @endif" required>
                                            @if ($errors->has('firstName'))
                                                <span class="text-danger">{{ $errors->first('firstName') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter last name" value="@if ($user->lastName != '') {{$user->lastName}} @endif" required>
                                            @if ($errors->has('lastName'))
                                                <span class="text-danger">{{ $errors->first('lastName') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Father Name -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Father Name</label>
                                        <div class="col-md-12">
                                            <input type="text" id="fatherName" name="fatherName" class="form-control" placeholder="Enter Father's Name" value="@if ($user->fatherName != '') {{$user->fatherName}} @endif" required>
                                            @if ($errors->has('fatherName'))
                                                <span class="text-danger">{{ $errors->first('fatherName') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--CNIC -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">CNIC</label>
                                        <div class="col-md-12">
                                            <input type="text" id="cnic_no" name="cnic_no" class="form-control" placeholder="Enter CNIC Number" value="@if ($user->cnic_no != '') {{$user->cnic_no}} @endif" required>
                                            @if ($errors->has('cnic_no'))
                                                <span class="text-danger">{{ $errors->first('cnic_no') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Email -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" readonly value="@if ($user->email != '') {{$user->email}} @endif" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Phone -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Phone Number</label>
                                        <div class="col-md-12">
                                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" readonly value="@if ($user->phone != '') {{$user->phone}} @endif" required>
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Password -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password">
                                            @if ($errors->has('confirm_password'))
                                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="error" style="color:red"></span><br />
                                </div>
                                <div class="row">
                                    <!-- Date of Birth -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="dob">Date of Birth</label>
                                        <div class="col-md-12">
                                            <input type="text" id="dob" name="dob" class="form-control mydatepicker" placeholder="Enter your birth date" value="@if ($user->dob != '') {{$user->dob}} @endif" autocomplete="off" required>
                                            @if ($errors->has('dob'))
                                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Gender -->
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-12">Gender</label>
                                        <div class="col-sm-12">
                                            <select name="gender_id" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="1" @if ($user->gender_id == '1') selected @endif>Male</option>
                                                <option value="2" @if ($user->gender_id == '2') selected @endif>Female</option>
                                            </select>
                                            @if ($errors->has('gender_id'))
                                                <span class="text-danger">{{ $errors->first('gender_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Qualification</label>
                                        <div class="col-md-12">
                                            <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Enter Qualification" value="@if ($user->qualification != '') {{$user->qualification}} @endif" required>
                                            @if ($errors->has('qualification'))
                                                <span class="text-danger">{{ $errors->first('qualification') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Experience</label>
                                        <div class="col-md-12">
                                            <input type="text" id="experience" name="experience" class="form-control" placeholder="Enter Experience" value="@if ($user->experience != '') {{$user->experience}} @endif" required>
                                            @if ($errors->has('experience'))
                                                <span class="text-danger">{{ $errors->first('experience') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-md-12" for="example-text">Profile Picture</label>
                                        <div class="col-md-12">
                                            <div class="profile-style profile" style="text-align: center"><img alt="user" src="@if ($profile!='0') {{url($showarray.$profile)}} @else {{url('admin_assets/images/user.png')}} @endif" style="width: 200px; height: 150px"></div>
                                            <input type="file" id="profile_picture" name="profile_picture" class="form-control" placeholder="Choose Photo"
                                                   style="text-align: center" >
                                            @if ($errors->has('profile_picture'))
                                                <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-md-12" for="example-text">CNIC Front</label>
                                        <div class="col-md-12">
                                            <div class="profile-style cnicfront" style="text-align: center"><img alt="user" src="@if ($cnicfront!='0') {{url($showarray.$cnicfront)}} @else {{url('admin_assets/images/user.png')}} @endif" style="width: 200px; height: 150px"></div>
                                            <input type="file" id="cnic_front" name="cnic_front" class="form-control" placeholder="Choose Photo"
                                                   style="text-align: center">
                                            @if ($errors->has('cnic_front'))
                                                <span class="text-danger">{{ $errors->first('cnic_front') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-md-12" for="example-text">CNIC Back</label>
                                        <div class="col-md-12">
                                            {{--'http://dev-tutor4all-api.shayansolutions.com/images/'.--}}
                                            <div class="profile-style cnicback" style="text-align: center"><img alt="user" src="@if ($cnicback!='0') {{url($showarray.$cnicback)}} @else {{url('admin_assets/images/user.png')}} @endif" style="width: 200px; height: 150px"></div>
                                            <input type="file" id="cnic_back" name="cnic_back" class="form-control" placeholder="Choose Photo"
                                                   style="text-align: center"
                                                   >
                                            @if ($errors->has('cnic_back'))
                                                <span class="text-danger">{{ $errors->first('cnic_back') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10 pull-right" style="margin-top: -9px;">Submit</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script src="{{url('admin_assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Form Wizard JavaScript -->
    <script src="{{url('admin_assets/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js')}}"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" href="{{url('admin_assets/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}">
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="{{url('admin_assets/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
    <script src="{{url('admin_assets/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#dob').datepicker({
                format: 'yyyy-mm-dd'
            });
            var allowsubmit = false;
            $(function(){
                //on keypress
                $('#confirm_password').keyup(function(e){
                    //get values
                    var password = $('#password').val();
                    var confirm_password = $(this).val();

                    //check the strings
                    if(password == confirm_password){
                        //if both are same remove the error and allow to submit
                        $('.error').text('');
                        allowsubmit = true;
                    }else{
                        //if not matching show error and not allow to submit
                        $('.error').text('Password does not match');
                        allowsubmit = false;
                    }
                });
//                $("#cnic_back").change(function(e) {
//                    var image, file;
//                    if ((file = this.files[0])) {
//
//                        image = new Image();
//                        image.onload = function() {
//                            console.log('inhere');
//
//                            src = this.src;
//                            $('.cnicback').html('<img src="'+ src +'"></div>');
//                            e.preventDefault();
//                        }
//                    };
////                    image.src = _URL.createObjectURL(file);
//                });
                //jquery form submit
                $('#form').submit(function(){

                    var password = $('#password').val();
                    var confirm_password = $('#confirm_password').val();

                    //just to make sure once again during submit
                    //if both are true then only allow submit
                    if(password == confirm_password){
                        allowsubmit = true;
                    }
                    if(allowsubmit){
                        return true;
                    }else{
                        return false;
                    }
                });
            });
        });
    </script>
@stop
