@extends('admin.layout')
@section('title','Reports')

@section('styles')
    <style>
        .dt-buttons {
            margin-top: 10px;
        }

        select[name="myTable_length"] {
            padding: 0;
            line-height: 10px;
        }

        .dataTables_length > label {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors Session Reports </h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Reports</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="white-box">

                <h3 class="box-title m-b-0">Tutors Session Reports</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Location:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6  placeholder">
                                <select id="" data-role-id="2"  name="ratings" class="form-control black-333 countries">
                                    <option value="all">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->country}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="form-control black-333 provinces">
                                    <option value="all">Select Province</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="form-control black-333 cities">
                                    <option value="all">Select City</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 placeholder">
                                <select id="" name="ratings" class="form-control black-333 areas">
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
                                <input type="text" name="dates" class="form-control" autocomplete="off" value="" placeholder="Last Login" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Active/InActive:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 active_record">
                                    <option value="all">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Experience:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_experience form-control" placeholder="Min">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_experience form-control" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Rate:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_rating form-control" placeholder="Min">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_rating form-control" placeholder="Max">
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
                                <input type="number" placeholder="Min" class="form-control min_age">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Max" class="form-control max_age">
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
                                <select id="ratings" name="ratings" class="form-control black-333">
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
                    <div class="col-md-12">
                        <div class="col-md-3" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                            <button class="btn apply-filter" style="background-color: #ab8ce4; color: white"> Apply filter</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-md-10"></div>

                    <br>
                    <br>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Booked</th>
                            <th>Started</th>
                            <th>Completed</th>
                            <th>Missed</th>
                            <th>Pending</th>
                            <th>Rejected</th>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                cancelLabel: 'Clear'
            }
        });
        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });



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
                if($('.online_status').val() != '' && $('.online_status').val() !== '0' )
                    filterDataArray['online_status'] = $('.online_status').val();
                if($('input[name="dates"]').val() != '')
                    filterDataArray['last_login'] = $('input[name="dates"]').val();
                if($('.min_experience').val() != '')
                    filterDataArray['min_experience'] = $('.min_experience').val();
                if($('.max_experience').val() != '')
                    filterDataArray['max_experience'] = $('.max_experience').val();
                if($('.min_rating').val() != '')
                    filterDataArray['min_rating'] = $('.min_rating').val();
                if($('.max_rating').val() != '')
                    filterDataArray['max_rating'] = $('.max_rating').val();
                if($('.active_record').val() != '')
                    filterDataArray['active_record'] = $('.active_record').val();
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
                if($('#ratings').val() != '')
                    filterDataArray['rating'] = $('#ratings').val();

                fetch_data(filterDataArray);
            });
            $('body').on('change','.online_status',function ()
            {
                var value = $(this).val();
                if(value === '0')
                    $('.last_login').removeClass('hide');
                else {
                    if($('.last_login').not('.hide'))
                        $('.last_login').addClass('hide');
                }
            });
            function fetch_data(filterDataArray = '') {


                let table = $('#myTable').DataTable({
                    dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('reports') }}",
                        data: {filterDataArray : filterDataArray},
                        complete: function (data) {
                            // Switchery
                            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                            $('.js-switch').each(function () {
                                new Switchery($(this)[0], $(this).data());
                                var base_url = $(this).data('url');
                            });

                            // Switchery
                            var elems = Array.prototype.slice.call(document.querySelectorAll('.is_approved_by_admin'));
                            $('.is_approved_by_admin').each(function () {
                                new Switchery($(this)[0], $(this).data());
                                var base_url = $(this).data('url');
                            });
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'firstName', name: 'firstName'},
                        {data: 'lastName', name: 'lastName'},
                        {data: 'booked', name: 'booked'},
                        {data: 'started', name: 'started'},
                        {data: 'completed', name: 'completed'},
                        {data: 'missed', name: 'missed'},
                        {data: 'pending', name: 'pending'},
                        {data: 'rejected', name: 'rejected'},
                    ],
                    "columnDefs": [
                        {
                            "targets": [0],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    buttons: [
                        {
                            extend: 'csv', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                            }
                        },
                        {
                            extend: 'excel', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                            }
                        },
                        {
                            extend: 'print', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4', '5', '6', '7', '8'],
                            }
                        }
                    ],
                    search: {
                        "regex": true
                    },
                    "bSort": false
                });

                // Event listener to the two range filtering inputs to redraw on input
                $('#ratings').change(function () {
                    table.draw();
                });
            }
        });


    </script>
    <script>
        $(document).ready(function()
        {
            $('body').on('change','.countries',function()
            {
                var value = $(this).val();
                var role = $(this).data('role-id');
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('country',value);
                    fd.append('role_id',role);
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url : "{{URL::to('/admin/tutors/fetchProvince')}}",
                        type : 'POST',
                        data : fd,
                        dataType: 'html',
                        contentType: false,
                        processData: false,
                        success:function (response) {
                            $('.provinces').html(response);
                        }
                    });
                }
                else {
                    $('.provinces').html('<option value="all">Select Province</option>');
                    $('.cities').html('<option value="all">Select City</option>');
                    $('.areas').html('<option value="all">Select Area List</option>');
                }
            });
            $('body').on('change','.provinces',function()
            {
                var value = $(this).val();
                var role = $('.countries').data('role-id');
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('province',value);
                    fd.append('role_id',role);
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url : "{{URL::to('/admin/tutors/fetchCity')}}",
                        type : 'POST',
                        data : fd,
                        dataType: 'html',
                        contentType: false,
                        processData: false,
                        success:function (response) {
                            $('.cities').html(response);
                        }
                    });
                }
                else {
                    $('.cities').html('<option value="all">Select City</option>');
                    $('.areas').html('<option value="all">Select Area List</option>');
                }
            });
            $('body').on('change','.cities',function()
            {
                var value = $(this).val();
                var role = $('.countries').data('role-id');
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('city',value);
                    fd.append('role_id',role);
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url : "{{URL::to('/admin/tutors/fetchArea')}}",
                        type : 'POST',
                        data : fd,
                        dataType: 'html',
                        contentType: false,
                        processData: false,
                        success:function (response) {
                            $('.areas').html(response);
                        }
                    });
                }
                else {
                    $('.areas').html('<option value="all">Select Area List</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $('#classes').select2({
                placeholder: "Select Classes ",
            });
            $('#subjects').select2({
                placeholder: "Select Subjects ",
            });
            $('body').on('change','.classes',function()
            {
                var value = $(this).val();
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('class',value);
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url : "{{URL::to('/admin/tutors/fetchSubjects')}}",
                        type : 'POST',
                        data : fd,
                        dataType: 'html',
                        contentType: false,
                        processData: false,
                        success:function (response) {
                            $('.subjects').html(response);
                        }
                    });
                }
                else {
                    $('.subjects').html('<option value="all">Select Subjects</option>');
                }
            });
        });
    </script>
@stop
<style>
    .black-333 {
        color: #333333;
    }
</style>
