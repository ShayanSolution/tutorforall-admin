@extends('admin.layout')
@section('title','studentProfile')

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
                <h4 class="page-title">Student Profile</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    {{--<li><a href="#">Admin</a></li>--}}
                    {{--<li class="active">TutorProfile</li>--}}
                    <li><a class="btn btn-inverse waves-effect waves-light" style="color: white;"
                           href="/zukerbend/student/list">Back</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box" style="text-align: center">
                        <h4><b>Profile Picture</b></h4>
                        @if($user->profileImage == 'http://tutor4all-api.shayansolutions.com' || $user->profileImage == null || $user->profileImage == "")
                            <div class="profile-style" style="text-align: center"><img alt="user" src="{{url('admin_assets/images/user.png')}}">
                            </div>
                        @else
                            <div class="profile-style" style="text-align: center"><img alt="user" src="{{ config('services.studentprofileimage').$user->profileImage}}" style="max-width: 200px; max-height: 300px">
                            </div>

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
                            </div>
                            <!-- /.tabs1 -->
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
