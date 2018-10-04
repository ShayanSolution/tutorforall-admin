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
                            <div class="user-bg"> <img width="100%" alt="user" src="{{ env('TUTOR_IMAGE_URL').$user->profileImage}}"> </div>
                        @else
                            <div class="user-bg"> <img width="100%" alt="user" src="{{url('admin_assets/images/default.png')}}">
                        @endif
                        <div class="user-btm-box">
                            <!-- .row -->
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Name</strong>
                                    <p>{{$user->firstName." ".$user->lastName}}</p>
                                </div>
                            </div>
                            <!-- /.row -->
                            <hr>
                            <!-- .row -->
                            <div class="row text-center m-t-10">
                                <div class="col-md-6 b-r"><strong>Email ID</strong>
                                    <p>{{$user->email}}</p>
                                </div>
                                <div class="col-md-6"><strong>Phone</strong>
                                    <p>{{$user->phone}}</p>
                                </div>
                            </div>
                            <!-- /.row -->
                            <hr>
                            <div class="row text-center m-t-10">
                                <div class="col-md-6 b-r"><strong>Qualification</strong>
                                    <p>{{$user->qualification}}</p>
                                </div>
                                <div class="col-md-6"><strong>Experience</strong>
                                    <p>{{$user->experience}}</p>
                                </div>
                            </div>
                            <hr>
                            <!-- .row -->
                            <div class="row text-center m-t-10">
                                <div class="col-md-12"><strong>Address</strong>
                                    <p>{{$user->address}}</p>
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
                            <div class="tab-pane active" id="home">
                                <div class="steamline">
                                    <hr>
                                    @foreach($user->rating as $review)
                                        @if ($review->review != null)
                                            <div class="sl-item">
                                                <div class="sl-right">
                                                    <div class="m-l-40">{{--<a href="" class="text-info">Jane Doe</a>--}}
                                                        <p class="m-t-10"> {{$review->review}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                        @endforeach
                                </div>
                            </div>
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