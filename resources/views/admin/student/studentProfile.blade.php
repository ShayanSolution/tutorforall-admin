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
                                <a href="#walletTab" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Debit/Credit</span> </a>
                            </li>
                            <li class="tab">
                                <a href="#biography" data-toggle="tab"> <span class="visible-xs"><i
                                                class="fa fa-home"></i></span> <span class="hidden-xs">Biography</span>
                                </a>
                            </li>
                        </ul>
                        <!-- /.tabs -->
                        <div class="tab-content">
                            <!-- .tabs 1 -->
                            <div class="tab-pane active col-md-12" id="walletTab">
                            <!-- .Wallet are Start -->
                                <div class="row col-md-5">
                                        <div class="panel panel-default block2" style="outline: auto;">
                                            <div class="panel-heading">
                                                Wallet
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <form id="validation" class="form-horizontal" action="{{route('financialAspects')}}" method="POST">
                                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                                    <input type="hidden" value="student" name="role">
                                                    {{ csrf_field() }}
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="row col-md-4">
                                                                <label for="">Type</label>
                                                                <select name="type" required>
                                                                    <option value="">Select Type</option>
                                                                    <option value="credit">Credit</option>
                                                                    <option value="debit">Debit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="row col-md-4">
                                                                <label for="">Amount</label>
                                                                <input id="amount" type="number" min="0" name="amount" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="row col-md-4">
                                                            <label for="">Reason</label>
                                                            <textarea id="reason" type="text" name="reason_from_admin" value="" style="margin: 0px; width: 225px; height: 100px;" required></textarea>
                                                        </div>
                                                    </div>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10 pull-right">OK</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            <!-- /.Wallet are end -->
                                <!-- .Empty Start -->
                                <div class="row col-md-1"></div>
                                <!-- /.Empty end -->
                            <!-- /.Listing Start -->
                                <div class="row col-md-6">
                                    <div class="panel panel-default block2" style="outline: auto; padding-bottom: 10px">
                                            <div class="panel-heading">
                                                Transactions
                                            </div>
                                            <div class="panel-heading right">
                                                Total Wallet : {{$walletAmount}} PKR
                                            </div>
                                                @foreach($studentWallets as $studentWallet)
                                                <div class="panel panel-default block2" style="outline: auto; margin: 10px; padding: 5px">
                                                    @if($studentWallet)
                                                        {!!  '<b>Created At:</b> '.(dateTimeConverter(($studentWallet->created_at))) .'<br>'!!}
                                                        {!!  '<b>Created By:</b> '.$studentWallet->admin_user_name."-".$studentWallet->to_user_id.'<br>'!!}
                                                        {!!  '<b>Type:</b> '.$studentWallet->type.'<br>'!!}
                                                        {!!  '<b>Amount:</b> '.$studentWallet->amount.'<br>'!!}
                                                        {!!  '<b>Note:</b> '.$studentWallet->reason_from_admin.'<br>'!!}
                                                    @endif
                                                </div>
                                                @endforeach
                                        </div>
                                </div>
                            <!-- /.Listing end -->
                            </div>
                            <!-- /.tabs1 -->
                            <!-- .tabs 2 -->
                            <div class="tab-pane" id="biography">
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
                            <!-- /.tabs2 -->
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
