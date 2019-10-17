@extends('admin.layout')
@section('title','Dashboard')

@section('styles')
    <link href="/dashboard1.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard 1</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard 1</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-screen-desktop"></i></h3>
                                    <p class="text-muted">MYNEW CLIENTS</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-primary">23</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-note"></i></h3>
                                    <p class="text-muted">NEW PROJECTS</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-warning">169</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-doc"></i></h3>
                                    <p class="text-muted">NEW INVOICES</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-info">157</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-bag"></i></h3>
                                    <p class="text-muted">All PROJECTS</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-success">431</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Info box -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Over Visitor, Our income , slaes different and  sales prediction -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-40 align-items-center no-block">
                            <h5 class="card-title ">YEARLY SALES</h5>
                            <div class="ml-auto">
                                <ul class="list-inline font-12">
                                    <li><i class="fa fa-circle text-cyan"></i> Iphone</li>
                                    <li><i class="fa fa-circle text-primary"></i> Ipad</li>
                                    <li><i class="fa fa-circle text-purple"></i> Ipod</li>
                                </ul>
                            </div>
                        </div>
                        <div id="morris-area-chart" style="height: 340px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="340" version="1.1" width="672.656" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="32.859375" y="301" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,301H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="232" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,232H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="163" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,163H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="94" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,94H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,25H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647.656" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016</tspan></text><text x="547.3190451277954" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="446.982090255591" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014</tspan></text><text x="346.64513538338656" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="246.03328474440892" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="145.69632987220444" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="45.359375" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><path fill="#a3a3a3" stroke="none" d="M45.359375,255C70.44361371805111,236.6,120.61209115415333,184.84999999999997,145.69632987220444,181.39999999999998C170.78056859025557,177.94999999999996,220.9490460263578,220.509439124487,246.03328474440892,227.39999999999998C271.18624740415333,234.30943912448697,321.49217272364217,248.115731874145,346.64513538338656,236.6C371.72937410143766,225.115731874145,421.8978515375399,139.425,446.982090255591,135.4C472.0663289736421,131.375,522.2348064097444,212.45,547.3190451277954,204.39999999999998C572.4032838458465,196.34999999999997,622.5717612819489,104.35,647.656,71L647.656,301L45.359375,301Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="none" stroke="#888888" d="M45.359375,255C70.44361371805111,236.6,120.61209115415333,184.84999999999997,145.69632987220444,181.39999999999998C170.78056859025557,177.94999999999996,220.9490460263578,220.509439124487,246.03328474440892,227.39999999999998C271.18624740415333,234.30943912448697,321.49217272364217,248.115731874145,346.64513538338656,236.6C371.72937410143766,225.115731874145,421.8978515375399,139.425,446.982090255591,135.4C472.0663289736421,131.375,522.2348064097444,212.45,547.3190451277954,204.39999999999998C572.4032838458465,196.34999999999997,622.5717612819489,104.35,647.656,71" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.359375" cy="255" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="145.69632987220444" cy="181.39999999999998" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="246.03328474440892" cy="227.39999999999998" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="346.64513538338656" cy="236.6" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="446.982090255591" cy="135.4" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="547.3190451277954" cy="204.39999999999998" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="647.656" cy="71" r="3" fill="#888888" stroke="#888888" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#ea3232" stroke="none" d="M45.359375,227.39999999999998C70.44361371805111,222.79999999999998,120.61209115415333,206.7,145.69632987220444,209C170.78056859025557,211.3,220.9490460263578,257.284268125855,246.03328474440892,245.8C271.18624740415333,234.284268125855,321.49217272364217,127.3641586867305,346.64513538338656,117C371.72937410143766,106.6641586867305,421.8978515375399,151.5,446.982090255591,163C472.0663289736421,174.5,522.2348064097444,209,547.3190451277954,209C572.4032838458465,209,622.5717612819489,174.5,647.656,163L647.656,301L45.359375,301Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="none" stroke="#e20b0b" d="M45.359375,227.39999999999998C70.44361371805111,222.79999999999998,120.61209115415333,206.7,145.69632987220444,209C170.78056859025557,211.3,220.9490460263578,257.284268125855,246.03328474440892,245.8C271.18624740415333,234.284268125855,321.49217272364217,127.3641586867305,346.64513538338656,117C371.72937410143766,106.6641586867305,421.8978515375399,151.5,446.982090255591,163C472.0663289736421,174.5,522.2348064097444,209,547.3190451277954,209C572.4032838458465,209,622.5717612819489,174.5,647.656,163" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.359375" cy="227.39999999999998" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="145.69632987220444" cy="209" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="246.03328474440892" cy="245.8" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="346.64513538338656" cy="117" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="446.982090255591" cy="163" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="547.3190451277954" cy="209" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="647.656" cy="163" r="3" fill="#e20b0b" stroke="#e20b0b" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#ebcb4b" stroke="none" d="M45.359375,282.6C70.44361371805111,268.8,120.61209115415333,233.14999999999998,145.69632987220444,227.39999999999998C170.78056859025557,221.64999999999998,220.9490460263578,243.49056087551298,246.03328474440892,236.6C271.18624740415333,229.690560875513,321.49217272364217,180.26101231190148,346.64513538338656,172.2C371.72937410143766,164.1610123119015,421.8978515375399,165.29999999999998,446.982090255591,172.2C472.0663289736421,179.1,522.2348064097444,234.29999999999998,547.3190451277954,227.39999999999998C572.4032838458465,220.49999999999997,622.5717612819489,144.6,647.656,117L647.656,301L45.359375,301Z" fill-opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path><path fill="none" stroke="#f1c411" d="M45.359375,282.6C70.44361371805111,268.8,120.61209115415333,233.14999999999998,145.69632987220444,227.39999999999998C170.78056859025557,221.64999999999998,220.9490460263578,243.49056087551298,246.03328474440892,236.6C271.18624740415333,229.690560875513,321.49217272364217,180.26101231190148,346.64513538338656,172.2C371.72937410143766,164.1610123119015,421.8978515375399,165.29999999999998,446.982090255591,172.2C472.0663289736421,179.1,522.2348064097444,234.29999999999998,547.3190451277954,227.39999999999998C572.4032838458465,220.49999999999997,622.5717612819489,144.6,647.656,117" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.359375" cy="282.6" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="145.69632987220444" cy="227.39999999999998" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="246.03328474440892" cy="236.6" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="346.64513538338656" cy="172.2" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="446.982090255591" cy="172.2" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="547.3190451277954" cy="227.39999999999998" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="647.656" cy="117" r="3" fill="#f1c411" stroke="#f1c411" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 542.25px; top: 37px; display: none;"><div class="morris-hover-row-label">2016</div><div class="morris-hover-point" style="color: #888">
                                    iPhone:
                                    250
                                </div><div class="morris-hover-point" style="color: #e20b0b">
                                    iPad:
                                    150
                                </div><div class="morris-hover-point" style="color: #f1c411">
                                    iPod Touch:
                                    200
                                </div></div></div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card bg-dark text-white">
                            <div class="card-body ">
                                <div class="row weather">
                                    <div class="col-6 m-t-40">
                                        <h3>&nbsp;</h3>
                                        <div class="display-4">73<sup>°F</sup></div>
                                        <p class="text-white">AHMEDABAD, INDIA</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h1 class="m-b-"><i class="wi wi-day-cloudy-high"></i></h1>
                                        <b class="text-white">SUNNEY DAY</b>
                                        <p class="op-5">April 14</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div id="myCarouse2" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                            <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br>laugh at the moment</h4>
                                            <div class="d-flex no-block">
                                                <span><img src="../assets/images/users/1.jpg" alt="user" width="50" class="img-circle"></span>
                                                <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br>laugh at the moment</h4>
                                            <div class="d-flex no-block">
                                                <span><img src="../assets/images/users/2.jpg" alt="user" width="50" class="img-circle"></span>
                                                <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="carousel-item active">
                                            <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br>laugh at the moment</h4>
                                            <div class="d-flex no-block">
                                                <span><img src="../assets/images/users/3.jpg" alt="user" width="50" class="img-circle"></span>
                                                <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Comment - table -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- Comment widgets -->
            <!-- ============================================================== -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Comments</h5>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Comment widgets -->
                    <!-- ============================================================== -->
                    <div class="comment-widgets ps ps--theme_default ps--active-y" id="comment" style="height: 630px;position: relative;" data-ps-id="11d252c5-b7b5-1ae6-9085-037cb6938d32">
                        <!-- Comment Row -->
                        <div class="d-flex no-block comment-row">
                            <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
                            <div class="comment-text w-100">
                                <h5 class="font-medium">James Anderson</h5>
                                <p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                <div class="comment-footer">
                                    <span class="text-muted pull-right">April 14, 2016</span> <span class="badge badge-pill badge-info">Pending</span> <span class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                                </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex no-block comment-row border-top">
                            <div class="p-2"><span class="round"><img src="../assets/images/users/2.jpg" alt="user" width="50"></span></div>
                            <div class="comment-text active w-100">
                                <h5 class="font-medium">Michael Jorden</h5>
                                <p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
                                <div class="comment-footer">
                                    <span class="text-muted pull-right">April 14, 2016</span>
                                    <span class="badge badge-pill badge-success">Approved</span>
                                    <span class="action-icons active">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-close"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart text-danger"></i></a>
                                                </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex no-block comment-row border-top">
                            <div class="p-2"><span class="round"><img src="../assets/images/users/3.jpg" alt="user" width="50"></span></div>
                            <div class="comment-text w-100">
                                <h5 class="font-medium">Johnathan Doeting</h5>
                                <p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                <div class="comment-footer">
                                    <span class="text-muted pull-right">April 14, 2016</span>
                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                    <span class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                                </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex no-block comment-row border-top">
                            <div class="p-2"><span class="round"><img src="../assets/images/users/4.jpg" alt="user" width="50"></span></div>
                            <div class="comment-text active w-100">
                                <h5 class="font-medium">Genelia doe</h5>
                                <p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
                                <div class="comment-footer">
                                    <span class="text-muted pull-right">April 14, 2016</span>
                                    <span class="badge badge-pill badge-success">Approved</span>
                                    <span class="action-icons active">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-close"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart text-danger"></i></a>
                                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 630px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 545px;"></div></div></div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="card-title">Sales Overview</h5>
                                <h6 class="card-subtitle">Check the monthly sales </h6>
                            </div>
                            <div class="ml-auto">
                                <select class="form-control b-0">
                                    <option>January</option>
                                    <option value="1">February</option>
                                    <option value="2" selected="">March</option>
                                    <option value="3">April</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-6">
                                <h3>March 2017</h3>
                                <h5 class="font-light m-t-0">Report for this month</h5></div>
                            <div class="col-6 align-self-center display-6 text-right">
                                <h2 class="text-success">$3,690</h2></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover no-wrap">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>PRICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="txt-oflo">Elite admin</td>
                                <td><span class="badge badge-success badge-pill">sale</span> </td>
                                <td class="txt-oflo">April 18, 2017</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="txt-oflo">Real Homes</td>
                                <td><span class="badge badge-info badge-pill">extended</span></td>
                                <td class="txt-oflo">April 19, 2017</td>
                                <td><span class="text-info">$1250</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="txt-oflo">Ample Admin</td>
                                <td><span class="badge badge-info badge-pill">extended</span></td>
                                <td class="txt-oflo">April 19, 2017</td>
                                <td><span class="text-info">$1250</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="txt-oflo">Medical Pro</td>
                                <td><span class="badge badge-danger badge-pill">tax</span></td>
                                <td class="txt-oflo">April 20, 2017</td>
                                <td><span class="text-danger">-$24</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td class="txt-oflo">Hosting press html</td>
                                <td><span class="badge badge-success badge-pill">sale</span></td>
                                <td class="txt-oflo">April 21, 2017</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td class="txt-oflo">Digital Agency PSD</td>
                                <td><span class="badge badge-success badge-pill">sale</span> </td>
                                <td class="txt-oflo">April 23, 2017</td>
                                <td><span class="text-danger">-$14</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td class="txt-oflo">Helping Hands</td>
                                <td><span class="badge badge-warning badge-pill">member</span></td>
                                <td class="txt-oflo">April 22, 2017</td>
                                <td><span class="text-success">$64</span></td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td class="txt-oflo">Ample Admin</td>
                                <td><span class="badge badge-info badge-pill">extended</span></td>
                                <td class="txt-oflo">April 19, 2017</td>
                                <td><span class="text-info">$1250</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Comment - chats -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Over Visitor, Our income , slaes different and  sales prediction -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-40 align-items-center no-block">
                            <h5 class="card-title ">SALES DIFFERENCE</h5>
                            <div class="ml-auto">
                                <ul class="list-inline font-12">
                                    <li><i class="fa fa-circle text-cyan"></i> SITE A</li>
                                    <li><i class="fa fa-circle text-primary"></i> SITE B</li>
                                </ul>
                            </div>
                        </div>
                        <div id="morris-area-chart2" style="height: 340px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="340" version="1.1" width="672.656" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="32.859375" y="301" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,301H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="232" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,232H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="163" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,163H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="94" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,94H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.859375" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan></text><path fill="none" stroke="#e0e0e0" d="M45.359375,25H647.656" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647.656" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016</tspan></text><text x="547.3190451277954" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="446.982090255591" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014</tspan></text><text x="346.64513538338656" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="246.03328474440892" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="145.69632987220444" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="45.359375" y="313.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><path fill="#e2e5ea" stroke="none" d="M45.359375,301L145.69632987220444,181.39999999999998L246.03328474440892,227.39999999999998L346.64513538338656,236.6L446.982090255591,135.4L547.3190451277954,204.39999999999998L647.656,71L647.656,301L45.359375,301Z" fill-opacity="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0.4;"></path><path fill="none" stroke="#b4becb" d="M45.359375,301L145.69632987220444,181.39999999999998L246.03328474440892,227.39999999999998L346.64513538338656,236.6L446.982090255591,135.4L547.3190451277954,204.39999999999998L647.656,71" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.359375" cy="301" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="145.69632987220444" cy="181.39999999999998" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="246.03328474440892" cy="227.39999999999998" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="346.64513538338656" cy="236.6" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="446.982090255591" cy="135.4" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="547.3190451277954" cy="204.39999999999998" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="647.656" cy="71" r="0" fill="#b4becb" stroke="#b4becb" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#0ddbe4" stroke="none" d="M45.359375,301L145.69632987220444,209L246.03328474440892,245.8L346.64513538338656,117L446.982090255591,163L547.3190451277954,218.2L647.656,163L647.656,301L45.359375,301Z" fill-opacity="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0.4;"></path><path fill="none" stroke="#01c0c8" d="M45.359375,301L145.69632987220444,209L246.03328474440892,245.8L346.64513538338656,117L446.982090255591,163L547.3190451277954,218.2L647.656,163" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.359375" cy="301" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="145.69632987220444" cy="209" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="246.03328474440892" cy="245.8" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="346.64513538338656" cy="117" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="446.982090255591" cy="163" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="547.3190451277954" cy="218.2" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="647.656" cy="163" r="0" fill="#01c0c8" stroke="#01c0c8" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">SALES DIFFERENCE</h5>
                                <div class="row">
                                    <div class="col-6  m-t-30">
                                        <h1 class="text-info">$647</h1>
                                        <p class="text-muted">APRIL 2017</p>
                                        <b>(150 Sales)</b> </div>
                                    <div class="col-6">
                                        <div id="sparkline2dash" class="text-right"><canvas width="88" height="154" style="display: inline-block; width: 88px; height: 154px; vertical-align: top;"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card bg-purple text-white">
                            <div class="card-body">
                                <h5 class="card-title">VISIT STATASTICS</h5>
                                <div class="row">
                                    <div class="col-6  m-t-30">
                                        <h1 class="text-white">$347</h1>
                                        <p class="light_op_text">APRIL 2017</p>
                                        <b class="text-white">(150 Sales)</b> </div>
                                    <div class="col-6">
                                        <div id="sales1" class="text-right"><canvas width="90" height="90" style="display: inline-block; width: 90px; height: 90px; vertical-align: top;"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Todo, chat, notification -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h5 class="card-title m-b-0">TO DO LIST</h5>
                            </div>
                            <div class="ml-auto">
                                <button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- To do list widgets -->
                        <!-- ============================================================== -->
                        <div class="to-do-widget m-t-20 ps ps--theme_default ps--active-y" id="todo" style="height: 400px;position: relative;" data-ps-id="beb6d478-c481-751e-2b52-01843e3c7ec2">
                            <!-- .modal for add task -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Task</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label>Task name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Task Name"> </div>
                                                <div class="form-group">
                                                    <label>Assign to</label>
                                                    <select class="custom-select form-control pull-right">
                                                        <option selected="">Sachin</option>
                                                        <option value="1">Sehwag</option>
                                                        <option value="2">Pritam</option>
                                                        <option value="3">Alia</option>
                                                        <option value="4">Varun</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                <li class="list-group-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">
                                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</span> <span class="badge badge-pill badge-danger float-right">Today</span>
                                        </label>
                                    </div>
                                    <ul class="assignedto">
                                        <li><img src="../assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                        <li><img src="../assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                        <li><img src="../assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                        <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">
                                            <span>Lorem Ipsum is simply dummy text of the printing</span><span class="badge badge-pill badge-primary float-right">1 week </span>
                                        </label>
                                    </div>
                                    <div class="item-date"> 26 jun 2017</div>
                                </li>
                                <li class="list-group-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">
                                            <span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
                                        </label>
                                    </div>
                                    <ul class="assignedto">
                                        <li><img src="../assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                        <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">
                                            <span>Lorem Ipsum is simply dummy text of the printing </span> <span class="badge badge-pill badge-warning float-right">2 weeks</span>
                                        </label>
                                    </div>
                                    <div class="item-date"> 26 jun 2017</div>
                                </li>
                                <li class="list-group-item" data-role="task">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4">
                                            <span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
                                        </label>
                                    </div>
                                    <ul class="assignedto">
                                        <li><img src="../assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                        <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 400px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 284px;"></div></div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">YOU HAVE 5 NEW MESSAGES</h5>
                        <div class="message-box ps ps--theme_default ps--active-y" id="msg" style="height: 430px;position: relative;" data-ps-id="b4ac1201-a519-6232-d0c4-f6ef57f36aeb">
                            <div class="message-widget message-scroll">
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been.</span> <span class="time">9:30 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <span class="round">A</span> <span class="profile-status away pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the printing and typesetting industry.</span> <span class="time">9:08 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Welcome to the Elite Admin</span> <span class="time">9:30 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)">
                                    <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                </a>
                            </div>
                            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 430px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 349px;"></div></div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CHAT</h5>
                        <div class="chat-box ps ps--theme_default ps--active-y" id="chat" style="height: 327px;position: relative;" data-ps-id="072cebf7-c920-5c90-416a-0d447c5a0af8">
                            <!--chat Row -->
                            <ul class="chat-list">
                                <!--chat Row -->
                                <li>
                                    <div class="chat-img"><img src="../assets/images/users/1.jpg" alt="user"></div>
                                    <div class="chat-content">
                                        <h5>James Anderson</h5>
                                        <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing &amp; type setting industry.</div>
                                    </div>
                                    <div class="chat-time">10:56 am</div>
                                </li>
                                <!--chat Row -->
                                <li>
                                    <div class="chat-img"><img src="../assets/images/users/2.jpg" alt="user"></div>
                                    <div class="chat-content">
                                        <h5>Bianca Doe</h5>
                                        <div class="box bg-light-info">It’s Great opportunity to work.</div>
                                    </div>
                                    <div class="chat-time">10:57 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="odd">
                                    <div class="chat-content">
                                        <div class="box bg-light-inverse">I would love to join the team.</div>
                                        <br>
                                    </div>
                                    <div class="chat-time">10:58 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="odd">
                                    <div class="chat-content">
                                        <div class="box bg-light-inverse">Whats budget of the new project.</div>
                                        <br>
                                    </div>
                                    <div class="chat-time">10:59 am</div>
                                </li>
                                <!--chat Row -->
                                <li>
                                    <div class="chat-img"><img src="../assets/images/users/3.jpg" alt="user"></div>
                                    <div class="chat-content">
                                        <h5>Angelina Rhodes</h5>
                                        <div class="box bg-light-info">Well we have good budget for the project</div>
                                    </div>
                                    <div class="chat-time">11:00 am</div>
                                </li>
                                <!--chat Row -->
                            </ul>
                            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 327px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 178px;"></div></div></div>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-8">
                                <textarea placeholder="Type your message here" class="form-control border-0"></textarea>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar ps ps--theme_default ps--active-y" data-ps-id="418e596c-4e4b-c2e8-9f0c-565cd185828a" style="display: block;">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme working">2</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px; height: 608px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 366px;"></div></div></div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    {{--<div class="container-fluid">--}}
        {{--<div class="row bg-title">--}}
            {{--@include('errors.common-errors')--}}
            {{--<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">--}}
                {{--<h4 class="page-title">Dashboard</h4> </div>--}}
            {{--<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li><a href="#">Admin</a></li>--}}
                    {{--<li class="active">Dashboard</li>--}}
                {{--</ol>--}}
            {{--</div>--}}
            {{--<!-- /.col-lg-12 -->--}}
        {{--</div>--}}
        {{--<!-- .row -->--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title">HTML Course</h3>--}}
                    {{--<div class="text-right"> <span class="text-muted">Monthly Fees</span>--}}
                        {{--<h1><sup><i class="ti-arrow-up text-success"></i></sup> $1200</h1>--}}
                    {{--</div>--}}
                    {{--<span class="text-success">20%</span>--}}
                    {{--<div class="progress m-b-0">--}}
                        {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title">Web Development Course</h3>--}}
                    {{--<div class="text-right"> <span class="text-muted">Monthly Fees</span>--}}
                        {{--<h1><sup><i class="ti-arrow-down text-danger"></i></sup> $5000</h1>--}}
                    {{--</div>--}}
                    {{--<span class="text-danger">30%</span>--}}
                    {{--<div class="progress m-b-0">--}}
                        {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title">Web Designing Course</h3>--}}
                    {{--<div class="text-right"> <span class="text-muted">Monthly Fees</span>--}}
                        {{--<h1><sup><i class="ti-arrow-up text-info"></i></sup> $8000</h1>--}}
                    {{--</div>--}}
                    {{--<span class="text-info">60%</span>--}}
                    {{--<div class="progress m-b-0">--}}
                        {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">20% Complete</span> </div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title">Android Development</h3>--}}
                    {{--<div class="text-right"> <span class="text-muted">Yearly Fees</span>--}}
                        {{--<h1><sup><i class="ti-arrow-up text-inverse"></i></sup> $12000</h1>--}}
                    {{--</div>--}}
                    {{--<span class="text-inverse">80%</span>--}}
                    {{--<div class="progress m-b-0">--}}
                        {{--<div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">230% Complete</span> </div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- /.row -->--}}
    {{--</div>--}}
@endsection