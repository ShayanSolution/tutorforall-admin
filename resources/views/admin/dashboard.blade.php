@extends('admin.layout')
@section('title','Dashboard')
@section('styles')
    <style>
        .new-bordered {
            border-style: solid !important;
            border-width: 15px !important;
            border-color: #EDF1F5 !important;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box col-md-12">
                <div class="col-md-4"><input id="tutorbtn" type="radio" value="tutor" onclick="showtutorfilters(this)" checked> Tutors
                </div>
                <div class="col-md-4"><input id="studentbtn" type="radio" value="student"
                                             onclick="showstudentfilters(this)"> Students
                </div>
                <input id="sessionbtn" type="radio" value="session" onclick="showsessionfilters(this)"> Sessions
            </div>
            <div class="white-box col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Location:</label>
                        <div class="row">
                            <div style="display:flex; margin-left: 5px">
                                <select id="" data-role-id="2" name="ratings"
                                        class="mySelectDropDown form-control black-333 countries">
                                    <option value="all">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->country}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                                {{--                            </div>--}}

                                {{--                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 provinces">
                                    <option value="all">Select Province</option>
                                </select>
                                {{--                            </div>--}}

                                {{--                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 cities">
                                    <option value="all">Select City</option>
                                </select>
                                {{--                            </div>--}}

                                {{--                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 areas">
                                    <option value="all">Select Area List</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Class & Subject:</label>
                        <div class="row">
                            <div style="display:flex; margin-left: 5px">
                                <select id="classes" name="ratings" class="form-control black-333 classes" multiple>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach()
                                </select>

                                <select id="subjects" name="ratings" class="form-control black-333 subjects" multiple>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Online & Last Login:</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 online_status">
                                    <option value="all">Online Status</option>
                                    <option value="1">Online</option>
                                    <option value="0">Last login</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 placeholder hide last_login">
                                <input type="text" name="dates" class="form-control" autocomplete="off" value=""
                                       placeholder="Last Login"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Active</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 active_record">
                                    <option value="all">All</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Gender:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 gender_record">
                                    <option value="all">Select</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Age:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Min" class="form-control min_age" min="0" max="100">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Max" class="form-control max_age" min="0" max="100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Experience:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_experience tutorfilter form-control" placeholder="Min" min="0">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_experience tutorfilter form-control" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Rate:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_rating tutorfilter form-control" placeholder="Min"  min="0">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_rating tutorfilter form-control" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Meet Point:</label>
                        <div class="row">
                            <div class="col-md-6 placeholder">
                                <select name="ratings" class="form-control tutorfilter black-333 meet_point">
                                    <option value="all">No Preference</option>
                                    <option value="0">Call Student</option>
                                    <option value="1">Go Home</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Rating filter:</label>
                        <div class="row">
                            <div class="col-md-6 placeholder">
                                <select name="ratings" class="form-control tutorfilter black-333 ratings">
                                    <option value="all">All</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">No of Session:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class=" studentfilter min_session form-control" placeholder="Min" min="0">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_session studentfilter form-control" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Deserving:</label>
                        <div class="row">
                            <div class="col-md-6 placeholder">
                                <select id="" name="ratings" class="form-control studentfilter black-333 deserving">
                                    <option value="all">All</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Session Rating</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_rate_star sessionfilter form-control" min="0"
                                       placeholder="Min">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_rate_star form-control sessionfilter" min="0" max="5"
                                       placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Date Range:</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 placeholder date_range">
                                <input type="text" name="dates" class="form-control dates" autocomplete="off" value="" placeholder="Date Range" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                            <button class="btn apply-filter" style="background-color: #ab8ce4; color: white"> Apply
                                filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Tutors</h2>
                <canvas id="activeInactiveTutors" width="90" height="20"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Students</h2>
                <canvas id="activeInactiveStudents" width="90" height="20"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Tutors / Students</h2>
                <canvas id="tutorsStudents" width="90" height="20"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Sessions</h2>
                <canvas id="sessions" width="90" height="20"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Tutors / Mentors</h2>
                <canvas id="tutorsAndMentors" width="90" height="20"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-12 new-bordered">
                <h2>Deserving / Non Deserving Students</h2>
                <canvas id="deservingAndNonDeservingStudents" width="90" height="20"></canvas>
            </div>
        </div>
    </div>

@endsection

@section('javascripts')


    <script src="{{url('admin_assets/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        let activeInactiveTutors = document.getElementById('activeInactiveTutors').getContext('2d');
        let activeInactiveStudents = document.getElementById('activeInactiveStudents').getContext('2d');
        let tutorsStudents = document.getElementById('tutorsStudents').getContext('2d');
        let sessions = document.getElementById('sessions').getContext('2d');
        let tutorsAndMentors = document.getElementById('tutorsAndMentors').getContext('2d');
        let deservingAndNonDeservingStudents = document.getElementById('deservingAndNonDeservingStudents').getContext('2d');
        let activetutorChart,activestudentChart, studentChart, sessionChart, tutormentorChart, deservingNonDeservingChart;
        setCharts();

        function setCharts() {

            activetutorChart = new Chart(
                activeInactiveTutors,
                {
                    options: {
                        hover: {mode: null},
                    },
                    "type": "doughnut",
                    "data": {
                        "labels": [
                            "{{$data['onlineTutors']}} Online",
                            "{{$data['offlineTutors']}} Offline"
                        ],
                        "datasets": [
                            {
                                "label": "Online / Offline Tutors",
                                "data": [
                                    {{$data['onlineTutors']}},
                                    {{$data['offlineTutors']}}
                                ],
                                "backgroundColor": [
                                    "rgb(54, 162, 235)",
                                    "rgb(255, 99, 132)"
                                ]
                            }
                        ]
                    }
                }
            );

            activestudentChart = new Chart(
                activeInactiveStudents,
                {
                    "type": "doughnut",
                    "data": {
                        "labels": [
                            "{{$data['activeStudents']}} Active",
                            "{{$data['inactiveStudents']}} Inactive"
                        ],
                        "datasets": [
                            {
                                "label": "Active / Inactive Students",
                                "data": [
                                    {{$data['activeStudents']}},
                                    {{$data['inactiveStudents']}}
                                ],
                                "backgroundColor": [
                                    "rgb(54, 162, 235)",
                                    "rgb(255, 99, 132)"
                                ]
                            }
                        ]
                    }
                }
            );
            studentChart = new Chart(
                tutorsStudents,
                {
                    "type": "bar",
                    "data": {
                        "labels": [
                            "{{$data['tutors']}} Tutors",
                            "{{$data['students']}} Students"
                        ],
                        "datasets": [
                            {
                                "label": "Tutors / Students",
                                "data": [
                                    {{$data['tutors']}},
                                    {{$data['students']}}
                                ],
                                "fill": false,
                                "backgroundColor": [
                                    "rgba(75, 192, 192, 0.2)",
                                    "rgba(255, 205, 86, 0.2)"
                                ],
                                "borderColor": [
                                    "rgb(75, 192, 192)",
                                    "rgb(255, 205, 86)"
                                ],
                                "borderWidth": 1
                            }
                        ]
                    },
                    "options": {
                        "scales": {
                            "yAxes": [
                                {
                                    "ticks": {
                                        "beginAtZero": true
                                    }
                                }
                            ]
                        }
                    }

                }
            );
            sessionChart = new Chart(
                sessions,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            "{{$data['sessionsBooked']}} Booked", "{{$data['sessionsStarted']}} Started", "{{$data['sessionsEnded']}} Ended", "{{$data['sessionsReject']}} Reject", "{{$data['sessionsPending']}} Pending", "{{$data['sessionsExpired']}} Expired",
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    {{$data['sessionsBooked']}},
                                    {{$data['sessionsStarted']}},
                                    {{$data['sessionsEnded']}},
                                    {{$data['sessionsReject']}},
                                    {{$data['sessionsPending']}},
                                    {{$data['sessionsExpired']}}
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)',
                                    'rgb(0,255,0,0.5)',
                                    'rgb(255,0,0,0.5)',
                                    'rgb(0,0,255,0.2)',
                                    'rgb(255,0,0,0.2)'
                                ]
                            }
                        ]
                    }
                }
            );

            tutormentorChart = new Chart(
                tutorsAndMentors,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            "{{$data['commercial_tutors']}} Tutors", "{{$data['mentor_tutors']}} Mentors"
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    {{$data['commercial_tutors']}},
                                    {{$data['mentor_tutors']}}
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)'
                                ]
                            }
                        ]
                    }
                }
            );

            deservingNonDeservingChart = new Chart(
                deservingAndNonDeservingStudents,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            "{{$data['non_deserving_students']}} Non Deserving Students", "{{$data['deserving_students']}} Deserving Students"
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    {{$data['non_deserving_students']}},
                                    {{$data['deserving_students']}}
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)'
                                ]
                            }
                        ]
                    }
                }
            );

        }
        document.getElementsByClassName('dates')[0].disabled = 'disabled';

        document.querySelectorAll('.sessionfilter').forEach((el, index) => {
            el.disabled = 'disabled';
            el.value = 'all';
        });
        document.querySelectorAll('.studentfilter').forEach((el, index) => {
            el.disabled = 'disabled';
            el.value = 'all';
        });
        function showtutorfilters($e) {
            if ($e.checked) {
                setCharts();
                document.getElementsByClassName('countries')[0].value = 'all';
                $('.classes').val('all').trigger('change');
                $('.subjects').val('all').trigger('change');

                document.querySelectorAll('.studentfilter').forEach((el, index) => {
                    el.disabled = 'disabled';
                    el.value = 'all';
                });
                document.querySelectorAll('.tutorfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.sessionfilter').forEach((el, index) => {
                    el.disabled = 'disabled';
                    el.value = 'all';
                });
                document.getElementById('studentbtn').checked = false;
                document.getElementById('sessionbtn').checked = false;
                document.getElementsByClassName('dates')[0].disabled = 'disabled';

                $('.gender_record option').remove();
                $('.gender_record').append('<option value="all">Select</option>\n<option value="1">Male</option>\n<option value="2">Female</option>');
                $('.meet_point option').remove();
                $('.meet_point').append('<option value="all">No Preference</option>\n<option value="0">Call Student</option>\n<option value="1">Go Home</option>');
                document.getElementsByClassName('online_status')[0].removeAttribute('disabled');
                document.getElementsByClassName('online_status')[0].value = 'all';
                document.getElementsByClassName('active_record')[0].removeAttribute('disabled');
                document.getElementsByClassName('active_record')[0].value = 'all';
                $('.countries').trigger( "change" );
                $('.last_login').addClass('hide').val('');
                $('.max_age').val('');
                $('.min_age').val('');
            } else {
                document.querySelectorAll('.studentfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.sessionfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
            }
        }

        function showstudentfilters($e) {
            if ($e.checked) {
                setCharts();
                document.getElementsByClassName('countries')[0].value = 'all';
                $('.classes').val('all').trigger('change');
                $('.subjects').val('all').trigger('change');

                document.querySelectorAll('.tutorfilter').forEach((el, index) => {
                    el.disabled = 'disabled';
                    el.value = 'all';
                });
                document.querySelectorAll('.studentfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.sessionfilter').forEach((el, index) => {
                    el.disabled = 'disabled';
                    el.value = 'all';
                });
                $('.gender_record option').remove();
                $('.gender_record').append('<option value="all">Select</option>\n<option value="1">Male</option>\n<option value="2">Female</option>');
                $('.meet_point option').remove();
                $('.meet_point').append('<option value="all">No Preference</option>\n<option value="1">Call Tutor</option>\n<option value="0">Go to Tutor</option>');
                document.getElementsByClassName('online_status')[0].removeAttribute('disabled');
                document.getElementsByClassName('online_status')[0].value = 'all';
                document.getElementsByClassName('active_record')[0].removeAttribute('disabled');
                document.getElementsByClassName('active_record')[0].value = 'all';
                document.getElementsByClassName('dates')[0].disabled = 'disabled';
                $('.countries').trigger( "change" );
                $('.last_login').addClass('hide');
                $('.last_login').val('');
                $('.max_age').val('');
                $('.min_age').val('');
                document.getElementById('tutorbtn').checked = false;
                document.getElementById('sessionbtn').checked = false;
            } else {
                document.querySelectorAll('.tutorfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.sessionfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
            }
        }

        function showsessionfilters($e) {
            if ($e.checked) {
                setCharts();
                document.getElementsByClassName('countries')[0].value = 'all';
                // document.getElementsByClassName('classes')[0].value = 'all';
                $('.classes').val('all').trigger('change');
                $('.subjects').val('all').trigger('change');
                // document.getElementsByClassName('subjects')[0].value = 'all';
                document.querySelectorAll('.tutorfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                $('.gender_record option').remove();
                $('.gender_record').append(' <option value="all">All</option>\n<option value="1,1">Both Male</option>\n<option value="2,2">Both Female</option>\n<option value="2,1">Student Female - Tutor Male</option>\n<option value="1,2">Student Male - Tutor Female</option>');
                $('.meet_point option').remove();
                $('.meet_point').append('<option value="all">No Preference</option>\n<option value="1">Call Tutor</option>\n<option value="0">Go to Tutor</option>');
                document.getElementsByClassName('online_status')[0].disabled = 'disabled';
                document.getElementsByClassName('online_status')[0].value = 'all';
                document.getElementsByClassName('active_record')[0].disabled = 'disabled';
                document.getElementsByClassName('active_record')[0].value = 'all';
                document.getElementsByClassName('dates')[0].removeAttribute('disabled');
                document.getElementsByClassName('ratings')[0].disabled = 'disabled';
                document.getElementsByClassName('ratings')[0].value = 'all';
                document.querySelectorAll('.sessionfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.studentfilter').forEach((el, index) => {
                    el.disabled = 'disabled';
                    el.value = 'all';
                });
                $('.countries').trigger( "change" );
                $('.last_login').addClass('hide');
                $('.last_login').val('');
                $('.max_age').val('');
                $('.min_age').val('');
                document.getElementById('tutorbtn').checked = false;
                document.getElementById('studentbtn').checked = false;
            } else {
                document.querySelectorAll('.tutorfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.querySelectorAll('.studentfilter').forEach((el, index) => {
                    el.removeAttribute('disabled');
                    el.value = 'all';
                });
                document.getElementsByClassName('ratings')[0].removeAttribute('disabled');

            }
        }

        $('body').on('click', '.apply-filter', function () {
            let filterDataArray = {};
            //Location data
            if ($('.countries').val() != '')
                filterDataArray['country'] = $('.countries').val();
            if ($('.provinces').val() != '')
                filterDataArray['province'] = $('.provinces').val();
            if ($('.cities').val() != '')
                filterDataArray['city'] = $('.cities').val();
            if ($('.areas').val() != '')
                filterDataArray['area'] = $('.areas').val();

            //Classes and subjects
            if ($('.classes').val() != '')
                filterDataArray['class'] = $('.classes').val();
            if ($('.subjects').val() != '')
                filterDataArray['subject'] = $('.subjects').val();

            //Online Status
            if ($('.online_status').val() != '' && $('.online_status').val() !== '0')
                filterDataArray['online_status'] = $('.online_status').val();
            if ($('input[name="dates"]').val() != '')
                filterDataArray['last_login'] = $('input[name="dates"]').val();
            if ($('.min_experience').val() != '')
                filterDataArray['min_experience'] = $('.min_experience').val();
            if ($('.max_experience').val() != '')
                filterDataArray['max_experience'] = $('.max_experience').val();
            if ($('.min_rating').val() != '')
                filterDataArray['min_rating'] = $('.min_rating').val();
            if ($('.max_rating').val() != '')
                filterDataArray['max_rating'] = $('.max_rating').val();
            if ($('.active_record').val() != '')
                filterDataArray['active_record'] = $('.active_record').val();
            if ($('.gender_record').val() != '')
                filterDataArray['gender_record'] = $('.gender_record').val();
            if ($('.min_age').val() != '')
                filterDataArray['min_age'] = $('.min_age').val();
            if ($('.max_age').val() != '')
                filterDataArray['max_age'] = $('.max_age').val();

            // Meet Point
            if ($('.meet_point').val() != '')
                filterDataArray['meet_point'] = $('.meet_point').val();

            //Rating Filter
            if ($('.ratings').val() != '')
                filterDataArray['rating'] = $('.ratings').val();

            // Deserving
            if ($('.deserving').val() != '')
                filterDataArray['deserving'] = $('.deserving').val();

            //min/max sessions
            if ($('.min_session').val() != '')
                filterDataArray['min_session'] = $('.min_session').val();
            if ($('.max_session').val() != '')
                filterDataArray['max_session'] = $('.max_session').val();

            //Rating Filter
            if ($('.min_rate_star').val() != '')
                filterDataArray['min_rate_star'] = $('.min_rate_star').val();
            if ($('.max_rate_star').val() != '')
                filterDataArray['max_rate_star'] = $('.max_rate_star').val();
            //Date Range Filter
            if($('.dates').val() != '')
                filterDataArray['date_range'] = $('.dates').val();

            let selectedFilter;
            document.querySelectorAll("input[type=radio]").forEach((_el, index) => {
                if (_el.checked) {
                    selectedFilter = _el.value;
                }
            });
            if (typeof (selectedFilter) == null || typeof (selectedFilter) == 'undefined') {
                alert("Please choose a type of filter");
            } else {

                console.log(filterDataArray, selectedFilter);
                $.ajax({
                    url: "{{ route('dashboard') }}",
                    data: {filterDataArray: filterDataArray, selectedFilter: selectedFilter},
                    success: function (data) {
                        console.log(data);
                        setCharts2(data);
                    },
                    beforeSend: function () {
                        $('.preloader').css('display', 'block');
                    },
                    complete: function (data) {
                        $('.preloader').css('display', 'none');
                    }
                });
            }
        });

        function setCharts2(data) {
            let node = $('#activeInactiveTutors').parent();
            node.empty();
            node.html('<h2>Tutors</h2><canvas id="activeInactiveTutors" width="90" height="20"></canvas>');
            node = $('#activeInactiveStudents').parent();
            node.empty();
            node.html('<h2>Students</h2><canvas id="activeInactiveStudents" width="90" height="20"></canvas>');
            node = $('#tutorsStudents').parent();
            node.empty();
            node.html('<h2>Tutors / Students</h2> <canvas id="tutorsStudents" width="90" height="20"></canvas>');
            node = $('#sessions').parent().empty();
            node.empty();
            node.html('<h2>Sessions</h2> <canvas id="sessions" width="90" height="20"></canvas>');
            node = $('#tutorsAndMentors').parent().empty();
            node.empty();
            node.html('  <h2>Tutors / Mentors</h2> <canvas id="tutorsAndMentors" width="90" height="20"></canvas>');
            node = $('#deservingAndNonDeservingStudents').parent().empty();
            node.empty();
            node.html('   <h2>Deserving / Non Deserving Students</h2> <canvas id="deservingAndNonDeservingStudents" width="90" height="20"></canvas>');
            deservingNonDeservingChart.destroy();
            tutormentorChart.destroy();
            activetutorChart.destroy();
            activestudentChart.destroy();
            studentChart.destroy();
            sessionChart.destroy();

            activeInactiveTutors = document.getElementById('activeInactiveTutors').getContext('2d');
            activeInactiveStudents = document.getElementById('activeInactiveStudents').getContext('2d');
            tutorsStudents = document.getElementById('tutorsStudents').getContext('2d');
            sessions = document.getElementById('sessions').getContext('2d');
            tutorsAndMentors = document.getElementById('tutorsAndMentors').getContext('2d');
            deservingAndNonDeservingStudents = document.getElementById('deservingAndNonDeservingStudents').getContext('2d');


             activetutorChart = new Chart(
                activeInactiveTutors,
                {
                    options: {
                        hover: {mode: null},
                    },
                    "type": "doughnut",
                    "data": {
                        "labels": [
                            data['onlineTutors'] + " Online",
                            data['offlineTutors'] + " Offline"
                        ],
                        "datasets": [
                            {
                                "label": "Online / Offline Tutors",
                                "data": [
                                    data['onlineTutors'],
                                    data['offlineTutors']
                                ],
                                "backgroundColor": [
                                    "rgb(54, 162, 235)",
                                    "rgb(255, 99, 132)"
                                ]
                            }
                        ]
                    }
                }
            );

            activestudentChart = new Chart(
                activeInactiveStudents,
                {
                    "type": "doughnut",
                    "data": {
                        "labels": [
                            data['activeStudents'] + " Active",
                            data['inactiveStudents'] + " Inactive"
                        ],
                        "datasets": [
                            {
                                "label": "Active / Inactive Students",
                                "data": [
                                    data['activeStudents'],
                                    data['inactiveStudents']
                                ],
                                "backgroundColor": [
                                    "rgb(54, 162, 235)",
                                    "rgb(255, 99, 132)"
                                ]
                            }
                        ]
                    }
                }
            );
             studentChart = new Chart(
                tutorsStudents,
                {
                    "type": "bar",
                    "data": {
                        "labels": [
                            data['tutors'] + " Tutors",
                            data['students'] + " Students"
                        ],
                        "datasets": [
                            {
                                "label": "Tutors / Students",
                                "data": [
                                    data['tutors'],
                                    data['students']
                                ],
                                "fill": false,
                                "backgroundColor": [
                                    "rgba(75, 192, 192, 0.2)",
                                    "rgba(255, 205, 86, 0.2)"
                                ],
                                "borderColor": [
                                    "rgb(75, 192, 192)",
                                    "rgb(255, 205, 86)"
                                ],
                                "borderWidth": 1
                            }
                        ]
                    },
                    "options": {
                        "scales": {
                            "yAxes": [
                                {
                                    "ticks": {
                                        "beginAtZero": true
                                    }
                                }
                            ]
                        }
                    }

                }
            );
            sessionChart = new Chart(
                sessions,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            data['sessionsBooked'] + " Booked", data['sessionsStarted'] + " Started", data['sessionsEnded'] + " Ended", data['sessionsReject'] + " Reject", data['sessionsPending'] + " Pending", data['sessionsExpired'] + " Expired",
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    data['sessionsBooked'],
                                    data['sessionsStarted'],
                                    data['sessionsEnded'],
                                    data['sessionsReject'],
                                    data['sessionsPending'],
                                    data['sessionsExpired']
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)',
                                    'rgb(0,255,0,0.5)',
                                    'rgb(255,0,0,0.5)',
                                    'rgb(0,0,255,0.2)',
                                    'rgb(255,0,0,0.2)'
                                ]
                            }
                        ]
                    }
                }
            );

            tutormentorChart = new Chart(
                tutorsAndMentors,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            data['commercial_tutors'] + " Tutors", data['mentor_tutors'] + " Mentors"
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    data['commercial_tutors'],
                                    data['mentor_tutors']
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)'
                                ]
                            }
                        ]
                    }
                }
            );

            deservingNonDeservingChart = new Chart(
                deservingAndNonDeservingStudents,
                {
                    "type": "pie",
                    "data": {
                        "labels": [
                            data['non_deserving_students'] + " Non Deserving Students", data['deserving_students'] + " Deserving Students"
                        ],
                        "datasets": [
                            {
                                "label": "Sessions",
                                "data": [
                                    data['non_deserving_students'],
                                    data['deserving_students']
                                ],
                                "backgroundColor": [
                                    'rgb(0,255,0,0.2)',
                                    'rgb(255,165,0, 0.5)'
                                ]
                            }
                        ]
                    }
                }
            );

        }

        $('body').on('change', '.online_status', function () {
            let value = $(this).val();
            if (value === '0')
                $('.last_login').removeClass('hide');
            else if(value === 'all')
                $('.last_login').addClass('hide');
            else {
                if ($('.last_login').not('.hide'))
                    $('.last_login').addClass('hide');
            }
        });
    </script>
    @parent
    @include('admin.includes.filter')
    <script>

    </script>

@endsection
