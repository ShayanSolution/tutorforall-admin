<!-- Navigation -->
<style>
    @media only screen and (min-width: 1000px){
        .logo{
            display: block;
        }
        .logo-mini{
            display: none;
        }
    }
    @media only screen and (max-width: 999px){
        .logo{
            display: none;
        }
        .logo-mini{
            display: block;
        }
    }
</style>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part" style="background-color: white;  vertical-align: center">
            <a href="/" class="logo-placeholder">
                <img src="{{url('logo-mini.png')}}" class="logo-small" alt="home" hidden style="width: 100%;">
                <img src="{{url('logo.png')}}" class="logo-full" alt="home" hidden style="width: 72%; margin-top: 4% !important; margin-left: 17%;">
                {{--<img src="{{url('logo.png')}}" class="logo-full" alt="home" hidden style="width: 91%; margin-top: 4% !important; margin-left: 3%;">--}}
                {{--<img src="{{url('logo-mini.png')}}" class="logo-small" alt="home" hidden style="width: 100%;">--}}
            </a>{{--<a class="logo" href="#">--}}
                {{--<b>--}}
                    {{--<img src="{{url('logo-mini.png')}}" alt="home" style="width:40px;" />--}}
                {{--</b>--}}
                {{--<span class="hidden-xs">--}}
                    {{--<strong>Tutor4All</strong>--}}
                {{--</span>--}}
            {{--</a>--}}
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="message-center">
                            <a href="index.html#">
                                <div class="user-img"> <img src="{{url('admin_assets/plugins/images/users/pawandeep.jpg')}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Shayan Solutions</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                            </a>
                            <a href="index.html#">
                                <div class="user-img"> <img src="{{url('admin_assets/plugins/images/users/sonu.jpg')}}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Shayan Solutions</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                            </a>
                            <a href="index.html#">
                                <div class="user-img"> <img src="{{url('admin_assets/plugins/images/users/arijit.jpg')}}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Shayan Solutions</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                            </a>
                            <a href="index.html#">
                                <div class="user-img"> <img src="{{url('admin_assets/plugins/images/users/pawandeep.jpg')}}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Shayan Solutions</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="index.html#"> <img src="{{Auth::user()->profileImage}}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{Auth::user()->username}}</b> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    {{--<li><a href="{{route('updatePasswordPage')}}"><i class="ti-settings"></i>Update Password</a></li>--}}
                    <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i>  Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
