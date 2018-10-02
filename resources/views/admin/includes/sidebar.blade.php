<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="{{route('dashboard')}}" class="waves-effect"><img src="{{Auth::user()->profileImage}}" alt="user-img" class="img-circle"> <span class="hide-menu">{{Auth::user()->username}}</span>
                </a>
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li> <a href="{{url('admin/dashboard')}}" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
            <li class="nav-small-cap m-t-10">--- Professional</li>
            <li> <a href="#" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Programs <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('programsList')}}">All Programs</a> </li>
                    <li> <a href="{{route('programAdd')}}">Add Program</a> </li>
                    {{--<li> <a href="#">Edit Professor</a> </li>--}}
                    {{--<li> <a href="#">Professor Profile</a> </li>--}}
                </ul>
            </li>
            <li> <a href="#" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Subjects <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('subjectsList')}}">All Subjects</a> </li>
                    <li> <a href="{{route('subjectAdd')}}">Add Subject</a> </li>
                    {{--<li> <a href="#">Edit Professor</a> </li>--}}
                    {{--<li> <a href="#">Professor Profile</a> </li>--}}
                </ul>
            </li>
            <li> <a href="#" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Tutors <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('tutorsList')}}">All Tutors</a> </li>
                    {{--<li> <a href="{{route('tutorAdd')}}">Add Tutor</a> </li>--}}
                    {{--<li> <a href="#">Edit Professor</a> </li>--}}
                    {{--<li> <a href="#">Professor Profile</a> </li>--}}
                </ul>
            </li>
            <li> <a href="#" class="waves-effect"><i class="fa fa-graduation-cap p-r-10"></i> <span class="hide-menu"> Students <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('studentsList')}}">All Students</a> </li>
                    {{--<li> <a href="#">Add Student</a> </li>--}}
                    {{--<li> <a href="#">Edit Student</a> </li>--}}
                    {{--<li> <a href="#">Student Profile</a> </li>--}}
                </ul>
            </li>
            {{--<li> <a href="#" class="waves-effect"><i class="fa fa-bars p-r-10"></i> <span class="hide-menu"> Courses <span class="fa arrow"></span></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li> <a href="#">All Courses</a> </li>--}}
                    {{--<li> <a href="#">Add Course</a> </li>--}}
                    {{--<li> <a href="#">Edit Course</a> </li>--}}
                    {{--<li> <a href="#">Course Information</a> </li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li> <a href="#" class="waves-effect"><i class="fa fa-building p-r-10"></i> <span class="hide-menu"> Department <span class="fa arrow"></span></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li> <a href="#">Departments</a></li>--}}
                    {{--<li> <a href="#">Add Department</a></li>--}}
                    {{--<li> <a href="#">Edit Department</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li> <a href="#" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Reports <span class="fa arrow"></span></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li> <a href="#">General Report</a></li>--}}
                    {{--<li> <a href="#">Income Report</a></li>--}}
                    {{--<li> <a href="#">Expense Report</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li><a href="{{route('logout')}}" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
        </ul>

    </div>
</div>
<!-- Left navbar-header end -->
