@extends('admin.layout')
@section('title','tutorProfile')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutor Profile</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">TutorProfile</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box">
                        @if($user->profileImage != '' || $user->profileImage != null)
                            <div class="profile-style" style="text-align: center"><img alt="user" src="{{ env('TUTOR_IMAGE_URL').$user->profileImage}}" style="max-width: 200px; height: auto"></div>
                        @else
                            <div class="profile-style" style="text-align: center"><img alt="user" src="{{url('admin_assets/images/user.png')}}"></div>
                        @endif
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
                                <a href="#biography" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Biography</span> </a>
                            </li>
                            <li class="tab">
                                <a href="#update" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Classes/Subjects</span> </a>
                            </li>
                            <li class="tab">
                                <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Reviews</span> </a>
                            </li>
                        </ul>
                        <!-- /.tabs -->
                        <div class="tab-content">
                            <!-- .tabs 1 -->
                            <div class="tab-pane active" id="biography">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">
                                            @if ($user->firstName != '' || $user->lastName  != '')
                                                {{$user->firstName." ".$user->lastName}}
                                            @else
                                                {{'Not Available'}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">
                                            @if ($user->mobile  != '')
                                                {{$user->mobile}}
                                            @else
                                                {{'Not Available'}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
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
                                <div class="table-responsive pro-rd p-t-10">
                                    <table class="table">
                                        @if (count($programs_subjects)>0)
                                            <tbody class="text-dark">
                                                <tr>
                                                    <th style="font-size:23px">Classes</th>
                                                    <th style="font-size:23px">Subjects</th>
                                                </tr>
                                                @foreach($programs_subjects as $program_subject)
                                                    <tr>
                                                        <td class="col-md-6"><span class="label label-megna label-rounded">{{($program_subject->program->name)}}</span></td>
                                                        <td class="col-md-6">{{($program_subject->subject->name)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            {{'Subjects Not Available'}}
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <!-- /.tabs1 -->
                            <!-- .tabs 2 -->
                            <div class="tab-pane" id="update">
                                <div class="row">
                                    <form id="validation" class="form-horizontal" action="{{route('tutorSubjectsUpdate')}}" method="POST">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        {{ csrf_field() }}
                                        @if (count($programs) > 0)
                                            @foreach($programs as $program)
                                                <div class="panel panel-default block2" style="outline: auto;">
                                                    <div class="panel-heading">
                                                        {{$program->name}}
                                                        <div class="panel-action"><a href="panel-ui-block.html#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                                                    </div>
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                            @php $subjects = \App\Models\Subject::where('programme_id',$program->id)->get(); @endphp
                                                            @if(count($subjects) > 0)
                                                                <div class="row">
                                                                    @foreach($subjects as $subject)
                                                                        <div class="row col-md-4">
                                                                            <div class="checkbox checkbox-primary">
                                                                                <input type="checkbox" name="subject_id[]" value="{{$subject->id}}" @if (in_array($subject->id,$user->program_subject->pluck('subject_id')->toArray())) checked @endif>
                                                                                <label>{{$subject->name}} </label>
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
                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10 pull-right">Update</button>
                                    </form>
                                </div>

                            </div>
                            <!-- /.tabs2 -->
                            {{--<!-- .tabs 3 -->--}}
                            <div class="tab-pane" id="home">
                                @if (count($user->rating)>0)
                                    <div class="steamline">
                                        <hr>
                                        @foreach($user->rating as $review)
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
                                            </div>
                                            <div class="sl-item">
                                                <div class="sl-right">
                                                    <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                        <p class="m-t-10">
                                                            @if ($review->review != '')
                                                                {{$review->review}}

                                                            @else
                                                                {{'Rewiew not found'}}
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
                        </div>
                            <!-- /.tabs 3 -->
                        </div>
                    </div>
                </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <!--BlockUI Script -->
{{--    <script src="{{url('admin_assets/plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>--}}
@stop