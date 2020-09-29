@extends('admin.layout')
@section('title','Sessions')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Session List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Session List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Session List Details</h3>
                <hr>
                {{--                    Location Filters start--}}
                {{-- Start Design By Muhammad Talha Jamshed --}}
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Location:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6  placeholder">
                                <select id="" data-session_page="{{$status}}" name="ratings" class="mySelectDropDown form-control black-333 countries">
                                    <option value="all">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->country}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 provinces">
                                    <option value="all">Select Province</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 cities">
                                    <option value="all">Select City</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="mySelectDropDown form-control black-333 areas">
                                    <option value="all">Select  Area List</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Class & Subject:</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6  placeholder">
                                <select id="classes" name="ratings" class="form-control black-333 classes" multiple>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach()
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 placeholder">
                                <select id="subjects" name="ratings" class="form-control black-333 subjects" multiple>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Date Range:</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 placeholder date_range">
                                <input type="text" name="dates" class="form-control" autocomplete="off" value="" placeholder="Date Range" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Rate:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_rate form-control" min="0" placeholder="Min">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_rate form-control" min="0" placeholder="Max">
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <label class="black-333">Active</label>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6  placeholder">--}}
{{--                                <select id="" name="ratings" class="form-control black-333 active_record">--}}
{{--                                    <option value="all">All</option>--}}
{{--                                    <option value="1">Yes</option>--}}
{{--                                    <option value="0">No</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Gender:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 gender_record">
                                    <option value="all">All</option>
                                    <option value="1,1">Both Male</option>
                                    <option value="2,2">Both Female</option>
                                    <option value="2,1">Student Female - Tutor Male</option>
                                    <option value="1,2">Student Male - Tutor Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Age:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Min" min="0" class="form-control min_age">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Max" min="0" class="form-control max_age">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Meet Point:</label>
                        <div class="row">
                            <div class="col-md-6 placeholder">
                                <select id="" name="ratings" class="form-control black-333 meet_point">
                                    <option value="all">No Preference</option>
                                    <option value="1">Call Tutor</option>
                                    <option value="0">Go to Tutor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($sessionStatus === 'sessionCompleted')
                        <div class="col-md-6 col-sm-6">
                            <label class="black-333">Session Rating</label>
                            <div class="row">
                                <div class="col-md-3 col-sm-6  placeholder">
                                    <input type="number" class="min_rate_star form-control" min="0" placeholder="Min">
                                </div>
                                <div class="col-md-3 col-sm-6 placeholder">
                                    <input type="number" class="max_rate_star form-control" min="0" max="5" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if($sessionStatus === 'sessionCompleted')
                    <div class="row">
                        <div class="col-md-6">
                            <label class="black-333">Tutor Experience:</label>
                            <div class="row">
                                <div class="col-md-3 col-sm-6  placeholder">
                                    <input type="number" class="min_experience form-control" min="0" placeholder="Min">
                                </div>
                                <div class="col-md-3 col-sm-6 placeholder">
                                    <input type="number" class="max_experience form-control" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                            <button class="btn apply-filter" style="background-color: #ab8ce4; color: white"> Apply filter</button>
                        </div>
                    </div>
                </div>
                {{-- End Design By Muhammad Talha Jamshed --}}
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Session ID</th>
                            <th>Student Name</th>
                            <th>Tutor Name</th>
                            <th>Class Name</th>
                            <th>Subject Name</th>
                            <th>Group Session</th>
                            <th>Group Members</th>
                            <th>Session Status</th>
                            <th>Duration</th>
                            <th>Session Location</th>
                            <th>Hourly Rate/RS</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    @include('admin.includes.filter')
    <script>
        $(document).ready(function () {
            fetch_data();
            $('body').on('click','.apply-filter',function ()
            {
                var filterDataArray = {};
                $('#myTable').DataTable().clear().destroy();
                //Location data
                if($('.countries').val() != '')
                    filterDataArray['country'] = $('.countries').val();
                if($('.provinces').val() != '')
                    filterDataArray['province'] = $('.provinces').val();
                if($('.cities').val() != '')
                    filterDataArray['city'] = $('.cities').val();
                if($('.areas').val() != '')
                    filterDataArray['area'] = $('.areas').val();

                //Classes and subjects
                if($('.classes').val() != '')
                    filterDataArray['class'] = $('.classes').val();
                if($('.subjects').val() != '')
                    filterDataArray['subject'] = $('.subjects').val();

                //Online Status
                if($('input[name="dates"]').val() != '')
                    filterDataArray['date_range'] = $('input[name="dates"]').val();

                if($('.min_experience').val() != '')
                    filterDataArray['min_experience'] = $('.min_experience').val();
                if($('.max_experience').val() != '')
                    filterDataArray['max_experience'] = $('.max_experience').val();

                if($('.min_rate').val() != '')
                    filterDataArray['min_rate'] = $('.min_rate').val();
                if($('.max_rate').val() != '')
                    filterDataArray['max_rate'] = $('.max_rate').val();
                if($('.gender_record').val() != '')
                    filterDataArray['gender_record'] = $('.gender_record').val();
                if($('.min_age').val() != '')
                    filterDataArray['min_age'] = $('.min_age').val();
                if($('.max_age').val() != '')
                    filterDataArray['max_age'] = $('.max_age').val();

                // Meet Point
                if($('.meet_point').val() != '')
                    filterDataArray['meet_point'] = $('.meet_point').val();

                //Rating Filter
                if($('.min_rate_star').val() != '')
                    filterDataArray['min_rate_star'] = $('.min_rate_star').val();
                if($('.max_rate_star').val() != '')
                    filterDataArray['max_rate_star'] = $('.max_rate_star').val();

                fetch_data(filterDataArray);
            });
            function fetch_data(filterDataArray = '')
            {
                let table = $('#myTable').DataTable({
                    dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax : {
                        url :"{{ route($sessionStatus) }}",
                        data: {filterDataArray : filterDataArray},
                        beforeSend: function(){
                            $('.preloader').css('display','block');
                        },
                        complete : function (data) {
                            $('.preloader').css('display','none');
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'studentName', name: 'studentName'},
                        {data: 'tutorName', name: 'tutorName'},
                        {data: 'className', name: 'className'},
                        {data: 'subjectName', name: 'subjectName'},
                        {data: 'groupSession', name: 'groupSession'},
                        {data: 'group_members', name: 'group_members'},
                        {data: 'status', name: 'status'},
                        {data: 'duration', name: 'duration'},
                        {data: 'session_location', name: 'session_location'},
                        {data: 'hourly_rate', name: 'hourly_rate'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                    buttons: [
                        { extend: 'csv', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } },
                        { extend: 'excel', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } },
                        { extend: 'print', className: 'btn-md', exportOptions: {
                                columns: ['0','1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                            } }
                    ],
                    search: {
                        "regex": true
                    },
                    "bSort": true
                });
            }
        });
    </script>
@stop
