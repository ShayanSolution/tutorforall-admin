@extends('admin.layout')
@section('title','tutorProfile')

@section('styles')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .fontHeading {
            font-size: 25px;
            font-weight: bold;
            text-decoration: underline;
        }

        .acceptColor {
            color: #01c0c8;
        }

        .rejectColor {
            color: red;
        }

        .pendingColor {
            color: lightslategray;
        }

        .acceptColorBg {
            background-color: #01c0c8;
        }

        .rejectColorBg {
            background-color: red;
        }

        .pendingColorBg {
            background-color: lightslategray;
        }

        .notUploadedColorBg {
            background-color: black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <?php
            $showarray = Config('app.api_url', 'www.test.com/');
            ?>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutor Profile</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    {{--<li><a href="#">Admin</a></li>--}}
                    {{--<li class="active">TutorProfile</li>--}}
                    <li><a class="btn btn-inverse waves-effect waves-light" style="color: white;"
                           href="/zukerbend/tutors/list">Back</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box" style="text-align: center">
                        <h4><b>Profile Picture</b></h4>
                        @if($profile == '0' || $profile == null)
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{url('admin_assets/images/user.png')}}">
                            </div>
                        @else
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{ $showarray.$profile}}"
                                                                                       style="max-width: 200px; max-height: 300px">
                            </div>

                        @endif
                        <h4><b>CNIC Front</b></h4>
                        @if($cnicfront == '0' || $cnicfront == null)
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{url('admin_assets/images/user.png')}}">
                            </div>
                        @else
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{ $showarray.$cnicfront}}"
                                                                                       style="max-width: 200px; max-height: 300px">
                            </div>
                        @endif
                        <h4><b>CNIC Back</b></h4>
                        @if($cnicback == '0' || $cnicback == null)
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{url('admin_assets/images/user.png')}}">
                            </div>
                        @else
                            <div class="profile-style" style="text-align: center"><img alt="user"
                                                                                       src="{{ $showarray.$cnicback}}"
                                                                                       style="max-width: 200px; max-height: 300px">
                            </div>
                        @endif
                        <div style="display: grid">
                            <a type="button" class="fcbtn btn btn-info btn-outline btn-1d"
                               style="margin: auto;margin-top: 5px;" href="{{route('tutorEdit',$user->id)}}">Edit</a>
                            <a type="button" class="fcbtn btn btn-warning btn-outline btn-1d"
                               style="margin: auto;margin-top: 5px;" href="{{route('candidateDocuments', $user->id)}}">Review
                                Documents</a>
                        </div>
                        <div class="user-btm-box">
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Full Name</strong>
                                    <p>@if ($user->firstName != '' || $user->lastName  != '')
                                            {{$user->firstName." ".$user->lastName}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Email ID</strong>
                                    <p>@if ($user->email != '')
                                            {{$user->email}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Phone</strong>
                                    <p>@if ($user->phone != '')
                                            {{$user->phone}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>CNIC Number</strong>
                                    <p>@if ($user->cnic_no != '')
                                            {{$user->cnic_no}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-6 b-r"><strong>Qualification</strong>
                                    <p>@if ($user->qualification != '')
                                            {{$user->qualification}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                                <div class="col-md-6"><strong>Experience</strong>
                                    <p>@if ($user->experience != '')
                                            {{$user->experience}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Address</strong>
                                    <p>@if ($user->address != '')
                                            {{$user->address}}
                                        @else
                                            {{'Not Available'}}
                                        @endif</p>
                                </div>
                            </div>

                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="white-box">
                        <!-- .tabs -->
                        <ul class="nav nav-tabs tabs customtab">
                            <li class="active tab">
                                <a href="#biography" data-toggle="tab"> <span class="visible-xs"><i
                                                class="fa fa-home"></i></span> <span class="hidden-xs">Biography</span>
                                </a>
                            </li>
                            <li class="tab">
                                <a href="#update" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Classes/Subjects</span> </a>
                            </li>
                            <li class="tab">
                                <a href="#home" data-toggle="tab"> <span class="visible-xs"><i
                                                class="fa fa-home"></i></span> <span class="hidden-xs">Reviews</span>
                                </a>
                            </li>
                            <li class="tab">
                                <a href="#settings" data-toggle="tab"> <span class="visible-xs"><i
                                                class="fa fa-home"></i></span> <span class="hidden-xs">Settings</span>
                                </a>
                            </li>
                            <li class="tab">
                                <a href="#tutor_invoices" data-toggle="tab"> <span class="visible-xs"><i
                                                class="fa fa-home"></i></span> <span
                                            class="hidden-xs">Earning History</span> </a>
                            </li>
                            <li class="tab">
                                <a href="#tutor_session_cancelled" data-toggle="tab"> <span class="visible-xs"><i
                                            class="fa fa-home"></i></span> <span
                                        class="hidden-xs">Cancelled Session</span> </a>
                            </li>
                        </ul>
                        <!-- /.tabs -->
                        <div class="tab-content">
                            <!-- .tabs 1 -->
                            <div class="tab-pane active" id="biography">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 b-r"><strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">
                                            @if ($user->firstName != '' || $user->lastName  != '')
                                                {{$user->firstName." ".$user->lastName}}
                                            @else
                                                {{'Not Available'}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"><strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">
                                            @if ($user->mobile  != '')
                                                {{$user->mobile}}
                                            @else
                                                {{'Not Available'}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"><strong>Email</strong>
                                        <br>
                                        <p class="text-muted">
                                            @if ($user->email  != '')
                                                {{$user->email}}
                                            @else
                                                {{'Not Available'}}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                {{--<div class="row"><h4 class="col-md-7" style="color: #686868"><strong>Classes</strong></h4><h4 class="col-md-5 pull-right" style="color: #686868"><strong>Subjects</strong></h4></div>--}}
                                <div id="accordion">

                                    <h3 class="fontHeading">Approved</h3>
                                    <div class="table-responsive pro-rd p-t-10">
                                        <table class="table">
                                            @if (count($programs_subjects)>0)
                                                <tbody class="text-dark">
                                                <tr>
                                                    <th style="font-size:23px">Classes</th>
                                                    <th style="font-size:23px">Subjects</th>
                                                </tr>
                                                @foreach($programs_subjects as $program_subject)
                                                    @if($program_subject->status == "Accepted" && $program_subject->document_id != 0)
                                                        <tr>
                                                            <td class="col-md-6"><span
                                                                        class="label label-megna label-rounded acceptColorBg">{{($program_subject->program->name)}}</span>
                                                            </td>
                                                            <td class="col-md-6">{{($program_subject->subject ? $program_subject->subject->name : '')}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            @else
                                                {{'Subjects Not Available'}}
                                            @endif
                                        </table>
                                    </div>

                                    <h3 class="fontHeading">Rejected</h3>
                                    <div class="table-responsive pro-rd p-t-10">
                                        <table class="table">
                                            @if (count($programs_subjects)>0)
                                                <tbody class="text-dark">
                                                <tr>
                                                    <th style="font-size:23px">Classes</th>
                                                    <th style="font-size:23px">Subjects</th>
                                                </tr>
                                                @foreach($programs_subjects as $program_subject)
                                                    @if( $program_subject->status == "Rejected" && $program_subject->document_id != 0)
                                                        <tr>
                                                            <td class="col-md-6"><span
                                                                        class="label label-megna label-rounded rejectColorBg">{{($program_subject->program->name)}}</span>
                                                            </td>
                                                            <td class="col-md-6">{{($program_subject->subject ? $program_subject->subject->name : '')}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            @else
                                                {{'Subjects Not Available'}}
                                            @endif
                                        </table>
                                    </div>

                                    <h3 class="fontHeading">Pending</h3>
                                    <div class="table-responsive pro-rd p-t-10">
                                        <table class="table">
                                            @if (count($programs_subjects)>0)
                                                <tbody class="text-dark">
                                                <tr>
                                                    <th style="font-size:23px">Classes</th>
                                                    <th style="font-size:23px">Subjects</th>
                                                </tr>
                                                @foreach($programs_subjects as $program_subject)
                                                    @if($program_subject->status == "Pending" && $program_subject->document_id != 0)
                                                        <tr>
                                                            <td class="col-md-6"><span
                                                                        class="label label-megna label-rounded pendingColorBg">{{($program_subject->program->name)}}</span>
                                                            </td>
                                                            <td class="col-md-6">{{($program_subject->subject ? $program_subject->subject->name : '')}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            @else
                                                {{'Subjects Not Available'}}
                                            @endif
                                        </table>
                                    </div>

                                    <h3 class="fontHeading">Document not uploaded</h3>
                                    <div class="table-responsive pro-rd p-t-10">
                                        <table class="table">
                                            @if (count($programs_subjects)>0)
                                                <tbody class="text-dark">
                                                <tr>
                                                    <th style="font-size:23px">Classes</th>
                                                    <th style="font-size:23px">Subjects</th>
                                                </tr>
                                                @foreach($programs_subjects as $program_subject)
                                                    @if($program_subject->status == "Pending" && $program_subject->document_id == 0)
                                                        <tr>
                                                            <td class="col-md-6"><span
                                                                        class="label label-megna label-rounded notUploadedColorBg">{{($program_subject->program->name)}}</span>
                                                            </td>
                                                            <td class="col-md-6">{{($program_subject->subject ? $program_subject->subject->name : '')}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            @else
                                                {{'Subjects Not Available'}}
                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /.tabs1 -->
                            <!-- .tabs 2 -->
                            <div class="tab-pane" id="update">
                                <div class="row">
                                    <form id="validation" class="form-horizontal"
                                          action="{{route('tutorSubjectsUpdate')}}" method="POST">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        {{ csrf_field() }}
                                        @if (count($programs) > 0)
                                            @foreach($programs as $program)
                                                <div class="panel panel-default block2" style="outline: auto;">
                                                    <div class="panel-heading">
                                                        {{$program->name}}
                                                        <div class="panel-action"><a href="panel-ui-block.html#"
                                                                                     data-perform="panel-collapse"><i
                                                                        class="ti-minus"></i></a></div>
                                                    </div>
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                            @php $subjects = \App\Models\Subject::where('programme_id',$program->id)->where('status',1)->get(); @endphp
                                                            @if(count($subjects) > 0)
                                                                <div class="row">
                                                                    @foreach($subjects as $subject)
                                                                        <div class="row col-md-4">
                                                                            <div class="checkbox checkbox-primary">
                                                                                <input id="{{$subject->id}}"
                                                                                       type="checkbox"
                                                                                       name="subject_id[]"
                                                                                       value="{{$subject->id}}"
                                                                                       @if (in_array($subject->id,$user->program_subject->pluck('subject_id')->toArray())) checked @endif>
                                                                                <label for="{{$subject->id}}">{{$subject->name}} </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    No Subjects Found
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{--                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10 pull-right">Update</button>--}}
                                    </form>
                                </div>

                            </div>
                            <!-- /.tabs2 -->
                            {{--<!-- .tabs 3 -->--}}
                            <div class="tab-pane" id="home">
                                @if (count($user->rating)>0)
                                    <div class="steamline">
                                        <hr>
                                        @foreach($user->rating()->with(['session.student'])->get() as $review)
                                            <div class="row">
                                                <span class="m-l-5 pull-right" style="color: orange;">
                                                        @if ($review->rating != null)
                                                        @php $rating = $review->rating; @endphp
                                                        @foreach(range(1,5) as $i)
                                                            @if($rating >0)
                                                                @if($rating >0.5)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-half-o"></i>
                                                                @endif
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                            <?php $rating--; ?>
                                                        @endforeach
                                                </span>
                                                <div class="sl-right">
                                                    <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                        <p class="m-t-10">
                                                            @if ($review->review != '')
                                                                @if($review->session->session_location)
                                                                    <?php $location = $review->session->session_location; ?>
                                                                    {!! '<i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;'.( strlen($location) >= 40 ? substr($location, 0, 40).'...' : $location).'<br>' !!}
                                                                @endif
                                                                @if($review->session)
                                                                    <?php
                                                                    $student = $review->session->student;
                                                                    $subject = $review->session->subject;
                                                                    $program = $review->session->class;
                                                                    ?>
                                                                    @if(!empty($student->firstName) || !empty($student->lastName))
                                                                        {!! '<b>"'.$student->firstName.' '.$student->lastName.'"</b>' !!}
                                                                    @else
                                                                        {!! '<b>"Anonymous"</b>' !!}
                                                                    @endif
                                                                    {!! '<br><i>('.$program->name.' - '.$subject->name.')</i>' !!}
                                                                    {!! '<div class="col-md-12" style="padding: 0"><hr style="width: 100px; float: left;"></div>' !!}
                                                                @endif
                                                                {!!  ($review->review) !!}
                                                            @else
                                                                {!! '<i>Review not found</i>' !!}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="sl-item">
                                        <div class="sl-right">
                                            <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                <p class="m-t-10"> No Reviews Found</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.tabs3 -->
                            {{--<!-- .tabs 4 -->--}}
                            <div class="tab-pane" id="settings">
                                <div class="row">
                                    <form id="validation" class="form-horizontal"
                                          action="{{route('tutorProfileUpdate')}}" method="POST">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        @php
                                            $userProfile = \App\Models\Profile::where('user_id', $user->id)->first();
                                        @endphp
                                        {{ csrf_field() }}
                                        <div class="panel panel-default block2" style="outline: auto;">
                                            <div class="panel-heading">
                                                How would you like to take Sessions?
                                                <div class="panel-action"><a href="panel-ui-block.html#"
                                                                             data-perform="panel-collapse"><i
                                                                class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row col-md-12">
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="group_tutor" type="radio"
                                                                       name="group_tutor_or_one_on_one"
                                                                       value="group_tutor"
                                                                       @if($userProfile->is_group && !($userProfile->is_group && $userProfile->one_on_one))   checked="checked" @endif>
                                                                <label for="group_tutor">Group Tutor</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="one_on_one" type="radio"
                                                                       name="group_tutor_or_one_on_one"
                                                                       value="one_on_one"
                                                                       @if($userProfile->one_on_one && !($userProfile->is_group && $userProfile->one_on_one))   checked="checked" @endif>
                                                                <label for="one_on_one">One On One</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="no_pref" type="radio"
                                                                       name="group_tutor_or_one_on_one" value="no_pref"
                                                                       @if(($userProfile->is_group && $userProfile->one_on_one))   checked="checked" @endif>
                                                                <label for="no_pref">No Preference</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default block2" style="outline: auto;">
                                            <div class="panel-heading">
                                                Where do you want to teach?
                                                <div class="panel-action"><a href="panel-ui-block.html#"
                                                                             data-perform="panel-collapse"><i
                                                                class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row col-md-12">
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="call_student" type="radio"
                                                                       name="call_student_or_go_home"
                                                                       value="call_student"
                                                                       @if($userProfile->call_student) checked="checked" @endif>
                                                                <label for="call_student">Call Student</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="go_home" type="radio"
                                                                       name="call_student_or_go_home" value="go_home"
                                                                       @if($userProfile->is_home) checked="checked" @endif>
                                                                <label for="go_home">Go Home</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="no_pref" type="radio"
                                                                       name="call_student_or_go_home" value="no_pref"
                                                                       @if(($userProfile->call_student && $userProfile->is_home))   checked="checked" @endif>
                                                                <label for="no_pref">No Preference</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default block2" style="outline: auto;">
                                            <div class="panel-heading">
                                                Who would you like to teach?
                                                <div class="panel-action"><a href="panel-ui-block.html#"
                                                                             data-perform="panel-collapse"><i
                                                                class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row col-md-12">
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="male" type="radio"
                                                                       name="who_would_you_like_to_teach" value="male"
                                                                       @if($userProfile->teach_to == 1) checked="checked" @endif>
                                                                <label for="male">Male</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="female" type="radio"
                                                                       name="who_would_you_like_to_teach" value="female"
                                                                       @if($userProfile->teach_to == 2) checked="checked" @endif>
                                                                <label for="female">Female</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="no_preference" type="radio"
                                                                       name="who_would_you_like_to_teach"
                                                                       value="no_preference"
                                                                       @if($userProfile->teach_to == 0) checked="checked" @endif>
                                                                <label for="no_preference">No Preference</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default block2" style="outline: auto;">
                                            <div class="panel-heading">
                                                Commercial/Mentor
                                                <div class="panel-action"><a href="panel-ui-block.html#"
                                                                             data-perform="panel-collapse"><i
                                                                class="ti-minus"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="row col-md-12">
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="male" type="radio"
                                                                       name="commercial_or_mentor" value="commercial"
                                                                       @if(!$userProfile->is_mentor) checked="checked" @endif>
                                                                <label for="male">Commercial</label>
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="radio radio-success">
                                                                <input id="female" type="radio"
                                                                       name="commercial_or_mentor" value="mentor"
                                                                       @if($userProfile->is_mentor) checked="checked" @endif>
                                                                <label for="female">Mentor</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit"
                                                class="btn btn-info waves-effect waves-light m-r-10 pull-right">Update
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tabs4 -->
                            {{--<!-- .tabs 5 -->--}}
                            <div class="tab-pane" id="tutor_invoices">
                                @php $payment_invoicestmp = $payment_invoices->orderBy('id','Desc')->get() @endphp
                                @if ($payment_invoicestmp->first()!=null)
                                    <div class="steamline">
                                        <hr>
                                        @php $n=1 @endphp
                                    @foreach($payment_invoices->orderBy('id','Desc')->get() as $review)
                                            @php $n++ @endphp
                                            <div class="row">
                                                <span class="m-l-5 pull-right" style="color: orange;" >
                                                    <a aria-controls={{"collapsedDate".$n}} aria-expanded="false" data-toggle="collapse" href={{"#collapsedDate".$n}} class="tooglesign">+</a>
                                                </span>
                                                <div class="sl-right">
                                                    <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                        @if($review->transaction_platform == 'card')
                                                            <div><b><i class="fa fa-credit-card"></i> &nbsp; {!! $review->session->rate.' PKR' !!}</b></div>
                                                        @endif
                                                        @if($review->transaction_platform == 'jazzcash')
                                                            <div><b><i class="fa fa-fighter-jet"></i> &nbsp; {!! $review->session->rate.' PKR' !!}</b></div>
                                                        @endif
                                                        @if($review->transaction_platform == 'cash')
                                                            <div><b><i class="fa fa-money"></i> &nbsp; {!! $review->session->rate.' PKR' !!}</b></div>
                                                        @endif
                                                        <p class="m-t-10">


                                                                @if($review->session)
                                                                <?php
                                                                $datetime = explode(" ",$review->session->started_at);
                                                                $date = $datetime[0];
                                                                $time = dateTimeConverter($review->session->started_at);
                                                                $subject = $review->session->subject;
                                                                $program = $review->session->class;
                                                                ?>

                                                                    @if(!empty($date))
                                                                        {!! '<b>'.$program->name.' - '.$subject->name.'</b>' !!}
                                                                    <br>
                                                                        {!! '&nbsp;'.$time.' &nbsp;' !!}
                                                                    @endif

                                                                </p>
                                                    </div>
                                                </div>
                                                <div id={{"collapsedDate".$n}} class="collapse">
                                                    <div class="sl-right">
                                                        <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                            <p class="m-t-10">
                                                    <?php $location = $review->session->session_location; ?>
                                                    <?php
                                                    $student = $review->session->student;
                                                    $subject = $review->session->subject;
                                                    $program = $review->session->class;
                                                    $duration = $review->session->duration;
                                                    $rate = $review->session->hourly_rate;
                                                    $total_amount = $review->session->rate;
                                                    $commisionPercentage = (int)\App\Models\Setting::where('slug','session_commision_percentage')->value('value');
                                                    $commission = ($commisionPercentage/100)*$rate;
                                                    $platform = $review->transaction_platform;
                                                    $transactionId = $review->transaction_ref_no;
                                                    $meetup_place = $review->session->is_home?"Student Location":"Teacher Location";

                                                                ?>
                                                            <div class="row">
                                                                <div class="col-sm-4">{!! '<b>Student Name: </b>'.$student->firstName.' '.$student->lastName.'' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Student Number: </b>'.$student->phone.'' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Meetup Point: </b>'.$meetup_place.'' !!}</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">{!! '<b>Duration: </b>'.$duration.'' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Total Amount: </b>'.$total_amount.' PKR' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Rate: </b>'.$rate.' PKR' !!}</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">{!! '<b>Commission: </b>'.$commission.'%' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Payment Platform: </b>'.$platform.'' !!}</div>
                                                                <div class="col-sm-4">{!! '<b>Transaction ID: </b>'.$transactionId.'' !!}</div>
                                                            </div>

                                                        {!! '<div class="col-md-12" style="padding: 0"><hr style="width: 100px; float: left;"></div>' !!}
                                                             @endif
                                                </div></div>
                                                </div>
                                            </div>
                                            <hr>
                                            {{--@endif--}}
                                        @endforeach
                                    </div>
                                @else
                                    <div class="sl-item">
                                        <div class="sl-right">
                                            <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                <p class="m-t-10"> No Sessions yet</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.tabs 5 -->
                            {{--<!-- .tabs 6 -->--}}
                            <div class="tab-pane" id="tutor_session_cancelled">
                                @if (count($cancelledSessions)>0)
                                    <div class="steamline">
                                        <hr>
                                        @foreach($cancelledSessions as $cancelledSession)
                                            <div class="row">
                                                <div class="sl-right">
                                                    <div class="m-l-40">
                                                        <p class="m-t-10">
                                                            <?php
                                                                $programName = \App\Models\Program::where('id', $cancelledSession->programme_id)->pluck('name');
                                                                $subjectName = \App\Models\Subject::where('id', $cancelledSession->subject_id)->pluck('name');
                                                            ?>
                                                        @if($cancelledSession)
                                                        {!!  '<b>Cancelled By:</b> '.($cancelledSession->cancelled_from) .'<br>'!!}
                                                        {!!  '<b>Session:</b> '.($programName.' - '.$subjectName) .'<br>'!!}
                                                        {!!  '<b>Session request at:</b> '.(dateTimeConverter($cancelledSession->created_at)) .'<br>'!!}
                                                        {!!  '<b>Session Location:</b> '.($cancelledSession->session_location) .'<br>'!!}
                                                        @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="sl-item">
                                        <div class="sl-right">
                                            <div class="m-l-40">
                                                <p class="m-t-10"> No Cancelled Sessions</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.tabs 6 -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        @endsection
        @section('javascripts')
            @parent

            <script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                    $("#accordion").accordion();
                })
                $('body').on('click','.tooglesign',function(){
                	if($(this).attr('aria-expanded') == 'true') $(this).html('+');
                	else $(this).html('-');
                })
            </script>
            <!--BlockUI Script -->
    {{--    <script src="{{url('admin_assets/plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>--}}
@stop
