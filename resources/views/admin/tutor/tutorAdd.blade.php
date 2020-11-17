@extends('admin.layout')
@section('title','tutorsAdd')

@section('styles')
    <style>
        .cnic::-webkit-outer-spin-button,
        .cnic::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
@endsection
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
                <h3 class="box-title m-b-0">Add Tutor Information</h3>
                {{--<p class="text-muted m-b-30 font-13"> Add Tutor's Information</p>--}}
                <div id="exampleValidator" class="wizard">
                    <ul class="wizard-steps" role="tablist">
                        <li class="active" role="tab">
                            <h4><span><i class="ti-user"></i></span>Add Information</h4> </li>
                        {{--<li role="tab">--}}
                            {{--<h4><span><i class="ti-credit-card"></i></span>Email ID</h4> </li>--}}
                        <li role="tab">
                            <h4><span><i class="ti-check"></i></span>Choose Class and Subject</h4> </li>
                    </ul>
                    <form id="validation" class="form-horizontal" action="{{route('tutorSave')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="wizard-content">
                            <div class="wizard-pane active" role="tabpanel">
                                <div class="row">
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
                                </div>
                                <div class="row">
                                    <!--Father Name -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Father Name</label>
                                        <div class="col-md-12">
                                            <input type="text" id="fatherName" name="fatherName" class="form-control" placeholder="Enter Father's Name" value="{{ old('fatherName') }}" required>
                                            @if ($errors->has('fatherName'))
                                                <span class="text-danger">{{ $errors->first('fatherName') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--CNIC -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">CNIC</label>
                                        <div class="col-md-12">
                                            <input type="number" id="cnic_no" name="cnic_no" class="form-control cnic" placeholder="Enter CNIC Number" value="{{ old('cnic_no') }}" required>
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
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Phone -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Phone Number</label>
                                        <div class="col-md-12">
                                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}" required>
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
                                </div>
                                <div class="row">
                                    <!-- Date of Birth -->
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="bdate">Date of Birth</label>
                                        <div class="col-md-12">
                                            <input type="date" id="dob" name="dob" class="form-control mydatepicker" placeholder="Enter your birth date" autocomplete="off" required>
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
                                                <option value="1" {{ (old("gender_id") == 1 ? "selected":"") }} >Male</option>
                                                <option value="2" {{ (old("gender_id") == 2 ? "selected":"") }} >Female</option>
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
                                            <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Enter Qualification" value="{{ old('qualification') }}" required>
                                            @if ($errors->has('qualification'))
                                                <span class="text-danger">{{ $errors->first('qualification') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12" for="example-text">Experience</label>
                                        <div class="col-md-12">
                                            <input type="text" id="experience" name="experience" class="form-control" placeholder="Enter Experience" value="{{ old('experience') }}">
                                            @if ($errors->has('experience'))
                                                <span class="text-danger">{{ $errors->first('experience') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-pane" role="tabpanel" style="outline: auto;">
                                @if (count($classes)>0)
                                    @foreach($classes as $class)
                                <div class="panel panel-default block2" style="outline: auto;">
                                    <div class="panel-heading">{{$class->name}}
                                        <div class="panel-action"><a href="panel-ui-block.html#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            {{--<p class=col-md-3>fdfdf</p>--}}
                                            @php $subjects = \App\Models\Subject::where('programme_id',$class->id)->get(); @endphp
                                            @if(count($subjects) > 0)
                                                <div class="row">
                                                @foreach($subjects as $subject)
                                                    <div class="checkbox checkbox-primary col-md-3">
                                                        <input type="checkbox" name="subject_id[]" value="{{$subject->id}}">
                                                        <label>{{$subject->name}} </label>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
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
    <!--BlockUI Script -->
    <script src="{{url('admin_assets/plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script>
        $(document).ready(function () {
            // $('#dob').datepicker({
            //     format: 'yyyy-mm-dd'
            // });

        $('#class').on('change', function(e){
            console.log(e);
            var class_id = e.target.value;
            console.log(class_id);
            $.get('{{url('/admin/getSubjects/')}}/'+class_id, function(data) {
                $('#subject').empty();
                console.log('Data: ', data.subjects);
                $.each(data.subjects, function(index,subCatObj){
                    console.log(subCatObj.name);
                    // $('#subject').append(''+subCatObj.name+'');
                    $('#subject').append($('<option>', {
                        value: subCatObj.id,
                        text : subCatObj.name
                    }));
                });
            });
        });

        });
    </script>
    <script type="text/javascript">
        (function () {
            $('#exampleValidator').wizard({
                onInit: function () {
                    $('#validation').formValidation({
                        framework: 'bootstrap',
                        fields: {
                            firstName: {
                                validators: {
                                    notEmpty: {
                                        message: 'The first name is required'
                                    }
                                    , stringLength: {
                                        min: 2
                                        , max: 30
                                        , message: 'The first name must be more than 6 and less than 30 characters long'
                                    }
                                    , regexp: {
                                        regexp: /^[a-zA-Z0-9_ \.]+$/
                                        ,
                                        message: 'The first name can only consist of alphabetical, number, dot and underscore'
                                    }
                                }
                            },
                            lastName: {
                                validators: {
                                    notEmpty: {
                                        message: 'The last name is required'
                                    }
                                    , stringLength: {
                                        min: 2
                                        , max: 30
                                        , message: 'The last name must be more than 6 and less than 30 characters long'
                                    }
                                    , regexp: {
                                        regexp: /^[a-zA-Z0-9_ \.]+$/
                                        ,
                                        message: 'The last name can only consist of alphabetical, number, dot and underscore'
                                    }
                                }
                            },
                            fatherName: {
                                validators: {
                                    notEmpty: {
                                        message: 'The father name is required'
                                    }
                                    , stringLength: {
                                        min: 2,
                                        max: 30,
                                        message: 'The father name must be more than 6 and less than 30 characters long'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                                        message: 'The father name can only consist of alphabetical, number, dot and underscore'
                                    }
                                }
                            },
                            cnic_no: {
                                validators: {
                                    notEmpty: {
                                        message: 'The CNIC number is required'
                                    },
                                    stringLength: {
                                        min: 6,
                                        max: 30,
                                        message: 'The CNIC number must be more than 6 and less than 30 characters long'
                                    }
                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: 'The email address is required'
                                    }
                                    , emailAddress: {
                                        message: 'The input is not a valid email address'
                                    }
                                }
                            },
                            phone: {
                                validators: {
                                    notEmpty: {
                                        message: 'Phone number is required'
                                    },
                                    regexp: {
                                        regexp: /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g,
                                        message: 'please enter valid phone number'
                                    },
                                    stringLength: {
                                        min: 7,
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: 'The password is required'
                                    },
                                    stringLength: {
                                        min: 6,
                                        max: 15
                                    },
                                    identical: {
                                        field: 'confirmPassword',
                                        message: 'The password and its confirm password are not the same'
                                    }
                                }
                            },
                            confirm_password: {
                                validators: {
                                    notEmpty: {
                                        message: 'The password is required'
                                    },
                                    identical: {
                                        field: 'password',
                                        message: 'The password and its confirm password are not the same'
                                    }
                                }
                            },
                            dob: {
                                validators: {
                                    notEmpty: {
                                        message: 'The date of birth is required'
                                    }
                                }
                            },
                            gender_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Gender is required'
                                    }
                                }
                            },
                            qualification: {
                                validators: {
                                    notEmpty: {
                                        message: 'Qualification is required'
                                    },
                                    stringLength: {
                                        min: 2,
                                    }
                                }
                            },
                            // experience: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Experience is required'
                            //         }
                            //     }
                            // },
                        }
                    });
                },
                validator: function () {
                    var fv = $('#validation').data('formValidation');
                    var $this = $(this);
                    // Validate the container
                    fv.validateContainer($this);
                    var isValidStep = fv.isValidContainer($this);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }
                    return true;
                }
                , onFinish: function () {
                    $('#validation')[0].submit();
                }
            });
        })();
    </script>
@stop
