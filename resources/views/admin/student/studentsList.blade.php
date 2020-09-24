@extends('admin.layout')
@section('title','studentsList')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Students List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Students List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <h3 class="box-title m-b-0">Students List Details</h3>
                <hr>
                {{--                    Location Filters start--}}
                {{-- Start Design By Muhammad Talha Jamshed --}}
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Location:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6  placeholder">
                                <select id="" name="ratings" class="form-control black-333 countries">
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
                                    <option value="all">Select Classes</option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach()
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 placeholder">
                                <select id="subjects" name="ratings" class="form-control black-333 subjects" multiple>
                                    <option value="all">Select Subjects</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Online & Last Login:</label>
                        <div class="row">
{{--                            <div class="col-md-6 col-sm-6  placeholder">--}}
{{--                                <select id="" name="ratings" class="form-control black-333 online_status">--}}
{{--                                    <option value="all">Online Status</option>--}}
{{--                                    <option value="1">Online</option>--}}
{{--                                    <option value="0">Last login</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="col-md-6 col-sm-6 placeholder last_login">
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
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
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
                                <input type="number" class="min_session form-control" placeholder="Min">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_session form-control" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="black-333">Deserving:</label>
                        <div class="row">
                            <div class="col-md-6 placeholder">
                                <select id="" name="ratings" class="form-control black-333 deserving">
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
                                <input type="number" placeholder="Min" class="form-control min_age">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" placeholder="Max" class="form-control max_age">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
{{--                    <div class="col-md-6 col-sm-6">--}}
{{--                        <label class="black-333">Meet Point:</label>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6 placeholder">--}}
{{--                                <select id="" name="ratings" class="form-control black-333 meet_point">--}}
{{--                                    <option value="all">No Preference</option>--}}
{{--                                    <option value="1">Call Tutor</option>--}}
{{--                                    <option value="0">Go to Tutor</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
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
                            <th hidden>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created</th>
                            <th>Active</th>
                            <th>Deserving</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <div id="deleteModalStudent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete this student?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="fcbtn btn btn-danger btn-1d deleteModalStudent" href="#" style="color: white">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                if($('.min_session').val() != '')
                    filterDataArray['min_session'] = $('.min_session').val();
                if($('.max_session').val() != '')
                    filterDataArray['max_session'] = $('.max_session').val();
                if($('.active_record').val() != '')
                    filterDataArray['active_record'] = $('.active_record').val();
                if($('.gender_record').val() != '')
                    filterDataArray['gender_record'] = $('.gender_record').val();
                if($('.min_age').val() != '')
                    filterDataArray['min_age'] = $('.min_age').val();
                if($('.max_age').val() != '')
                    filterDataArray['max_age'] = $('.max_age').val();
                // Deserving
                if($('.deserving').val() != '')
                    filterDataArray['deserving'] = $('.deserving').val();


                fetch_data(filterDataArray);
            });
            $('body').on('click', '.delete',function (){
                var id = $(this).data('id');
                var href = "{{URL::to('admin/student/delete')}}/"+id;
                $('.deleteModalStudent').attr("href", href);
                $('#deleteModalStudent').modal();
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
            function fetch_data(filterDataArray= '')
            {
                let table = $('#myTable').DataTable( {
                    dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-2"i><"col-sm-10"p>>',
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax : {
                        url : "{{ route('studentsList')}}",
                        data: {filterDataArray : filterDataArray},
                        complete : function (data) {
                            // Switchery
                            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                            $('.js-switch').each(function () {
                                new Switchery($(this)[0], $(this).data());
                            });
                            $('.js-switch-is_active').each(function () {
                                new Switchery($(this)[0], $(this).data());
                            });
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'firstName', name: 'firstName'},
                        {data: 'lastName', name: 'lastName'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'is_active', name: 'is_active'},
                        {data: 'is_deserving', name: 'is_deserving'},
                        {data: 'delete', name: 'delete'},
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    buttons: [
                        { extend: 'csv', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3'],
                            } },
                        { extend: 'excel', className: 'btn-md', exportOptions: {
                                columns: ['0','1', '2', '3'],
                            } },
                        { extend: 'print', className: 'btn-md', exportOptions: {
                                columns: ['0','1', '2', '3'],
                            } }
                    ],
                    search: {
                        "regex": true
                    },
                    "bSort": true
                } );
            }

            $('#classes').select2({
            });
            $('#subjects').select2({
            });

            var base_url = '{{url('/')}}';
            var _token = "{{csrf_token()}}";
            $('.js-switch').on('change.bootstrapSwitch', function(e) {
                var student_id = $(this).attr("data-student-id");
                $.ajax({
                    url:base_url+'/admin/changeStudentDeserving',
                    type: 'POST',
                    data: { student_id :student_id, is_deserving: e.target.checked, _token:_token},
                    success:function(response){
                        console.log(response);
                    }
                });
            });
            $('.js-switch-is_active').on('change.bootstrapSwitch',function (e) {
                var student_id = $(this).attr("data-student-id");
                $.ajax({
                    url:base_url+'/admin/changeStudentStatus',
                    type:'POST',
                    data:{student_id: student_id, is_active:e.target.checked, _token:_token},
                    success:function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function()
        {
            $('body').on('change','.countries',function()
            {
                var value = $(this).val();
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('country',value);
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
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('province',value);
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
                if(value !== 'all')
                {
                    var fd = new FormData();
                    fd.append('city',value);
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
@stop
<style>
    .black-333{
        color: #333333;
    }
    .col-md-6{
        margin-bottom:10px;
    }
    .select2
    {
        line-height: 31px;
        border: 1px solid #e4e7ea;
        border-radius: 0px;
        box-shadow: none;
    }
    .select2-container--default .select2-selection--multiple
    {
        border: 0px solid !important;
    }
</style>
