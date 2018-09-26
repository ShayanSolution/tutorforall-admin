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
    </div>
@endsection