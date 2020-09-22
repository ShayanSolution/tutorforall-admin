@extends('admin.layout')
@section('title','tutorsList')

@section('styles')
    <style>
        .dt-buttons{
            margin-top: 10px;
        }
        select[name="myTable_length"] {
            padding: 0;
            line-height: 10px;
        }
        .dataTables_length > label{
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors List ({{$mentorOrCommercial}})</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Tutors List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('tutorAdd')}}">Add Tutor</a>
                </div>
                <h3 class="box-title m-b-0">Tutors List Details</h3>
                <hr>
                <div class="table-responsive">
                    {{--                    Location Filters start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Location:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select Country</option>
                                    <option value="all">Pakistan</option>
                                </select>
                            </div>

                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select Province</option>
                                    <option value="all">Punjab</option>
                                </select>
                            </div>

                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select District</option>
                                    <option value="all">Lahore</option>
                                </select>
                            </div>

                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select  Area List</option>
                                    <option value="all">Gulberg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--                    Location Filters end--}}
                    {{--                    Online/Last Login Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Online & Last Login:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333 online_status" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Online Status</option>
                                    <option value="1">Online</option>
                                    <option value="0">Offline</option>
                                </select>
                            </div>

                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                {{--                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">--}}
                                {{--                                    <option value="all">Last Online</option>--}}
                                {{--                                </select>--}}
                                <input type="text" name="dates" value="" placeholder="Last Login" />
                            </div>

                        </div>
                    </div>
                    {{--                    Online/Last Login end--}}
                    {{--                    Class & Subject Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Class & Subject:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select Classes</option>
                                </select>
                            </div>

                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select Subjects</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    {{--                    Class & Subject end--}}
                    {{--                    Experience  Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Experience:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" class="min_experience" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" class="max_experience" placeholder="Max" style="width: 50px">
                            </div>

                        </div>
                    </div>
                    {{--                    Experience  end--}}
                    {{--                    Rate  Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Rate:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" class="min_rating" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" class="max_rating" placeholder="Max" style="width: 50px">
                            </div>

                        </div>
                    </div>
                    {{--                    Rate  end--}}
                    {{--                    active/inactive Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Active/InActive:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333 active_record" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--                    active/inactive end--}}
                    {{--                    gender Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Gender:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333 gender_record" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--                    gender end--}}
                    {{--                    Age  Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Age:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Min" class="min_age" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Max" class="max_age" style="width: 50px">
                            </div>

                        </div>
                    </div>
                    {{--                    Age  end--}}
                    {{--                    Age  Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">No. of Sessions:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Max" style="width: 50px">
                            </div>

                        </div>
                    </div>
                    {{--                    Age  end--}}
                    {{--                    Monthly/Hourly Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Monthly/Hourly:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--                    Monthly/Hourly end--}}
                    {{--                    Call Student/Go to Student  Start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Call Student/Go to Student :</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px">
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{--                    Call Student/Go to Student end--}}
                    {{--                    rating filter start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="black-333">Rating filter:</label>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding: 0; margin: 5px">
                            <div class="col-md-1 placeholder" style="padding: 0; margin-right: 10px">
                                <select id="ratings" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
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
                    {{--                    rating ends--}}

                    <div class="col-md-3" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                        <button class="btn apply-filter" style="background-color: #ab8ce4; color: white"> Apply filter</button>
                    </div>
                    <br>
                    <br>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Rating</th>
                            <th>Created</th>
                            <th>Last Login</th>
                            <th>Active</th>
                            <th>Approved</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- delete modal content -->
                        <div id="deleteModaltutor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-confirm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete this tutor?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        <a type="button" class="fcbtn btn btn-danger btn-1d modelDeleteBtn" href="#" style="color: white">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
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
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {

                let ratingSel = $('#ratings').val();

                if(
                    !isNaN(data[4]) &&
                    !isNaN(ratingSel) &&
                    (parseInt(data[4]) >= parseInt(ratingSel)) &&
                    (parseInt(data[4]) < parseInt(ratingSel)+1)
                    || ratingSel === 'all'
                )
                    return true;

                return false;
            }
        );

        $(document).ready(function () {
            fetch_data();
            //Start function by Muhammad Talha Jamshed
            $('body').on('click','.apply-filter',function ()
            {
                var filterDataArray = {};
                $('#myTable').DataTable().clear().destroy();
                if($('.online_status').val() != '')
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
                fetch_data(filterDataArray);
            });
            //End function by Muhammad Talha Jamshed
            function fetch_data(filterDataArray = '')
            {
                let table = $('#myTable').DataTable({
                    dom: '<"row"<"col-sm-2"l><"col-sm-6"B><"col-sm-4"fr>>t<"row"<"col-sm-2"i><"col-sm-10"p>>',
                    processing: true,
                    serverSide: true,
                    ajax : {
                        url : "{{ route('tutorsList') }}",
                        data: {filterDataArray : filterDataArray},
                        complete : function (data) {
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
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'rating', name: 'rating.rating'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'last_login', name: 'last_login'},
                        {data: 'is_active', name: 'is_active'},
                        {data: 'is_approve', name: 'is_approve'},
                        {data: 'edit', name: 'edit' },
                        {data: 'delete', name: 'delete' },
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
                                columns: ['0', '1', '2', '3', '4'],
                            } },
                        { extend: 'excel', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4'],
                            }  },
                        { extend: 'print', className: 'btn-md', exportOptions: {
                                columns: ['0', '1', '2', '3', '4'],
                            } }
                    ],
                    search: {
                        "regex": true
                    },
                    "bSort": true
                });
                // Event listener to the two range filtering inputs to redraw on input
                $('#ratings').change(function() {
                    table.draw();
                });
            }
        });
        $('body').on('click', '.delete',function (){
            var id = $(this).data('id');
            var href = "{{URL::to('admin/tutor/delete')}}/"+id;
            $('.modelDeleteBtn').attr("href", href);
            $('#deleteModaltutor').modal();
        });
        $('body').on('change.bootstrapSwitch','.js-switch', function(e) {
            var base_url = $(this).data('url');
            var tutor_id = $(this).attr("data-tutor-id");
            $.ajax({
                url:base_url+'/admin/changeTutorStatus',
                type: 'GET',
                data: { tutor_id :tutor_id, is_active: e.target.checked},
                success:function(response){
                    console.log(response);
                }
            });
        });

        $('body').on('change.bootstrapSwitch','.is_approved_by_admin', function(e) {
            var base_url = $(this).data('url');
            var tutor_id = $(this).attr("data-tutor-id");
            $.ajax({
                url:base_url+'/admin/changeTutorApprovedStatus',
                type: 'GET',
                data: { tutor_id :tutor_id, is_approved: e.target.checked},
                success:function(response){
                    console.log(response);
                }
            });

        });
    </script>
@stop
<style>
    .black-333{
        color: #333333;
    }
</style>
