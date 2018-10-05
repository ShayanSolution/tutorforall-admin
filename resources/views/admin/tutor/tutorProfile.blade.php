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
                                <div class="col-md-12"><strong>Name</strong>
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
                                <p>@if ($user->phone =! '')
                                        {{$user->phone}}
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
                            <!-- .row -->
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Address</strong>
                                    <p>@if ($user->experience != '')
                                            {{$user->address}}
                                        @else
                                            {{'Not Available'}}
                                    @endif</p>
                                </div>
                            </div>
                            <hr>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="white-box">
                        <!-- .tabs -->
                        <ul class="nav nav-tabs tabs customtab">
                            <li class="active tab">
                                <a href="professor-profile.html#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Reviews</span> </a>
                            </li>
                        </ul>
                        <!-- /.tabs -->
                        <div class="tab-content">
                            <!-- .tabs 1 -->
                            @if (count($user->rating)>0)
                            <div class="tab-pane active" id="home">
                                <div class="steamline">
                                    <hr>
                                    @foreach($user->rating as $review)
                                        <div class="row">
                                            <span class="m-l-5 pull-right" style="color: orange">
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
                                                        <p class="m-t-10"> @if ($review->review != '')
                                                                {{$review->review}}
                                                                               @else
                                                                               {{'Rewiew not found'}}
                                                        @endif</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
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
                            <!-- /.tabs1 -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script>
    </script>
@stop