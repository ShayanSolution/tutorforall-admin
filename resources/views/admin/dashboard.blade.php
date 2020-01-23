@extends('admin.layout')
@section('title','Dashboard')

@section('styles')
    <style>
        .new-bordered{
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
                <h4 class="page-title">Dashboard</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box col-md-6 new-bordered">
                <h2>Tutors</h2>
                <canvas id="activeInactiveTutors" width="50" height="30"></canvas>
            </div>
            <div class="white-box col-md-6 new-bordered">
                <h2>Students</h2>
                <canvas id="activeInactiveStudents" width="50" height="30"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="white-box col-md-6 new-bordered">
                <h2>Tutors / Students</h2>
                <canvas id="tutorsStudents" width="20" height="12"></canvas>
            </div>
            <div class="white-box col-md-6 new-bordered">
                <h2>Sessions</h2>
                <canvas id="sessions" width="20" height="12"></canvas>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        let activeInactiveTutors = document.getElementById('activeInactiveTutors').getContext('2d');
        let activeInactiveStudents = document.getElementById('activeInactiveStudents').getContext('2d');
        let tutorsStudents = document.getElementById('tutorsStudents').getContext('2d');
        let sessions = document.getElementById('sessions').getContext('2d');
        new Chart(
            activeInactiveTutors,
            {
                "type":"doughnut",
                "data":{
                    "labels":[
                        "Active",
                        "Inactive"
                    ],
                    "datasets":[
                        {
                            "label": "Active / Inactive Tutors",
                            "data": [
                                {{$data['activeTutors']}},
                                {{$data['inactiveTutors']}}
                            ],
                            "backgroundColor":[
                                "rgb(54, 162, 235)",
                                "rgb(255, 99, 132)"
                            ]
                        }
                    ]
                }
            }
        );
        new Chart(
            activeInactiveStudents,
            {
                "type":"doughnut",
                "data":{
                    "labels":[
                        "Active",
                        "Inactive"
                    ],
                    "datasets":[
                        {
                            "label": "Active / Inactive Students",
                            "data": [
                                {{$data['activeStudents']}},
                                {{$data['inactiveStudents']}}
                            ],
                            "backgroundColor":[
                                "rgb(54, 162, 235)",
                                "rgb(255, 99, 132)"
                            ]
                        }
                    ]
                }
            }
        );
        new Chart(
            tutorsStudents,
            {
                "type":"bar",
                "data":{
                    "labels":[
                        "Tutors",
                        "Students"
                    ],
                    "datasets":[
                        {
                            "label":"Tutors / Students",
                            "data":[
                                {{$data['tutors']}},
                                {{$data['students']}}
                            ],
                            "fill":false,
                            "backgroundColor":[
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(255, 205, 86, 0.2)"
                            ],
                            "borderColor": [
                                "rgb(75, 192, 192)",
                                "rgb(255, 205, 86)"
                            ],
                            "borderWidth":1
                        }
                    ]
                },
                "options":{
                    "scales":{
                        "yAxes":[
                            {
                                "ticks":{
                                    "beginAtZero":true
                                }
                            }
                        ]
                    }
                }

            }
        );
        new Chart(
            sessions,
            {
                "type":"pie",
                "data":{
                    "labels":[
                        'Booked','Started','Ended','Reject','Pending','Expired'
                    ],
                    "datasets":[
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
                            "backgroundColor":[
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
    </script>
@endsection
