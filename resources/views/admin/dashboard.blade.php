@extends('admin.layout')
@section('title','Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
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
        <!-- .row -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">HTML Course</h3>
                    <div class="text-right"> <span class="text-muted">Monthly Fees</span>
                        <h1><sup><i class="ti-arrow-up text-success"></i></sup> $1200</h1>
                    </div>
                    <span class="text-success">20%</span>
                    <div class="progress m-b-0">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Web Development Course</h3>
                    <div class="text-right"> <span class="text-muted">Monthly Fees</span>
                        <h1><sup><i class="ti-arrow-down text-danger"></i></sup> $5000</h1>
                    </div>
                    <span class="text-danger">30%</span>
                    <div class="progress m-b-0">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Web Designing Course</h3>
                    <div class="text-right"> <span class="text-muted">Monthly Fees</span>
                        <h1><sup><i class="ti-arrow-up text-info"></i></sup> $8000</h1>
                    </div>
                    <span class="text-info">60%</span>
                    <div class="progress m-b-0">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">20% Complete</span> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Android Development</h3>
                    <div class="text-right"> <span class="text-muted">Yearly Fees</span>
                        <h1><sup><i class="ti-arrow-up text-inverse"></i></sup> $12000</h1>
                    </div>
                    <span class="text-inverse">80%</span>
                    <div class="progress m-b-0">
                        <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">230% Complete</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">University Earnings</h3>
                    <span class="text-muted">All Earnings are in million $</span>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #021d3a;"></i>Arts</h5> </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #00a5e5;"></i>Commerce</h5> </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #00c292;"></i>Science</h5> </li>
                    </ul>
                    <div id="morris-bar-chart" style="height:372px;"></div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box m-b-15">
                    <h3 class="box-title">Earning From Medical college</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
                            <h1 class="text-info">$64057</h1>
                            <p class="text-muted">APRIL 2016</p> <b>(150 Sales)</b> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div id="sparkline2dash" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box bg-info m-b-15">
                    <h3 class="text-white box-title">Earning From Engineering college</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
                            <h1 class="text-white">$30447</h1>
                            <p class="light_op_text">APRIL 2016</p> <b class="text-white">(110 Sales)</b> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div id="sales1" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">


            <div class="col-md-3 col-xs-12 col-sm-6">
                <img class="img-responsive" alt="user" src="{{url('admin_assets/plugins/images/big/c2.jpg')}}">
                <div class="white-box">
                    <h4>Web Designing Courses</h4>
                    <div class="text-muted m-b-20"><span class="m-r-10"><i class="ti-alarm-clock"></i> 2 Year</span> <a class="text-muted m-l-10 m-r-10" href="index.html#"><i class="fa fa-heart-o"></i> 38</a><span class="m-l-10"><i class="fa fa-usd"></i> 50</span></div>
                    <p><span><i class="ti-alarm-clock"></i> Duration: 6 Months</span></p>
                    <p><span><i class="ti-user"></i> Professor: Jane Doe</span></p>
                    <p><span><i class="fa fa-graduation-cap"></i> Students: 200+</span></p>
                    <button class="btn btn-success btn-rounded waves-effect waves-light m-t-10">More Details</button>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <img class="img-responsive" alt="user" src="{{url('admin_assets/plugins/images/big/c1.jpg')}}">
                <div class="white-box">
                    <h4>Ios Development Course</h4>
                    <div class="text-muted m-b-20"><span class="m-r-10"><i class="ti-alarm-clock"></i> 2 Year</span> <a class="text-muted m-l-10 m-r-10" href="index.html#"><i class="fa fa-heart-o"></i> 38</a><span class="m-l-10"><i class="fa fa-usd"></i> 50</span></div>
                    <p><span><i class="ti-alarm-clock"></i> Duration: 6 Months</span></p>
                    <p><span><i class="ti-user"></i> Professor: Jane Doe</span></p>
                    <p><span><i class="fa fa-graduation-cap"></i> Students: 200+</span></p>
                    <button class="btn btn-success btn-rounded waves-effect waves-light m-t-10">More Details</button>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <img class="img-responsive" alt="user" src="{{url('admin_assets/plugins/images/big/c4.jpg')}}">
                <div class="white-box">
                    <h4>Android Development Course</h4>
                    <div class="text-muted m-b-20"><span class="m-r-10"><i class="ti-alarm-clock"></i> 2 Year</span> <a class="text-muted m-l-10 m-r-10" href="index.html#"><i class="fa fa-heart-o"></i> 38</a><span class="m-l-10"><i class="fa fa-usd"></i> 50</span></div>
                    <p><span><i class="ti-alarm-clock"></i> Duration: 6 Months</span></p>
                    <p><span><i class="ti-user"></i> Professor: Jane Doe</span></p>
                    <p><span><i class="fa fa-graduation-cap"></i> Students: 200+</span></p>
                    <button class="btn btn-success btn-rounded waves-effect waves-light m-t-10">More Details</button>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <img class="img-responsive" alt="user" src="{{url('admin_assets/plugins/images/big/c3.jpg')}}">
                <div class="white-box">
                    <h4>Web Development Course</h4>
                    <div class="text-muted m-b-20"><span class="m-r-10"><i class="ti-alarm-clock"></i> 2 Year</span> <a class="text-muted m-l-10 m-r-10" href="index.html#"><i class="fa fa-heart-o"></i> 38</a><span class="m-l-10"><i class="fa fa-usd"></i> 50</span></div>
                    <p><span><i class="ti-alarm-clock"></i> Duration: 6 Months</span></p>
                    <p><span><i class="ti-user"></i> Professor: Jane Doe</span></p>
                    <p><span><i class="fa fa-graduation-cap"></i> Students: 200+</span></p>

                    <button class="btn btn-success btn-rounded waves-effect waves-light m-t-10">More Details</button>
                </div>
            </div>
        </div>
    </div>
@endsection