@extends('admin.layout')
@section('title','tutorsDisbursementList')

@section('styles')
    {{--<style>--}}
    {{--.dt-buttons{--}}
    {{--margin-top: 10px;--}}
    {{--}--}}
    {{--select[name="myTable_length"] {--}}
    {{--padding: 0;--}}
    {{--line-height: 10px;--}}
    {{--}--}}
    {{--.dataTables_length > label{--}}
    {{--display: inline-block;--}}
    {{--}--}}
    {{--</style>--}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tutors Disbursements</h4></div>
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
                {{--<div class="col-lg-2 col-sm-4 col-xs-12 pull-right">--}}
                {{--<a type="button" class="btn btn-block btn-primary" href="{{route('tutorAdd')}}">Add Tutor</a>--}}
                {{--</div>--}}
                <h3 class="box-title m-b-0">Tutors Disbursements List</h3>
                <hr>
                {{--                    Location Filters start--}}
                {{-- Start Design By Muhammad Talha Jamshed --}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Location:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-3 col-sm-6 col-xs-6  placeholder">--}}
                {{--<select id="" data-role-id="2" name="ratings"--}}
                {{--class="mySelectDropDown form-control black-333 countries">--}}
                {{--<option value="all">Select Country</option>--}}
                {{--@foreach($countries as $country)--}}
                {{--<option value="{{$country->country}}">{{$country->country}}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--</div>--}}

                {{--<div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                {{--<select id="" name="ratings" class="mySelectDropDown form-control black-333 provinces">--}}
                {{--<option value="all">Select Province</option>--}}
                {{--</select>--}}
                {{--</div>--}}

                {{--<div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                {{--<select id="" name="ratings" class="mySelectDropDown form-control black-333 cities">--}}
                {{--<option value="all">Select City</option>--}}
                {{--</select>--}}
                {{--</div>--}}

                {{--<div class="col-md-3 col-sm-6 col-xs-6 placeholder">--}}
                {{--<select id="" name="ratings" class="mySelectDropDown form-control black-333 areas">--}}
                {{--<option value="all">Select Area List</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Class & Subject:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6 col-sm-6 col-xs-6  placeholder">--}}
                {{--<select id="classes" name="ratings" class="form-control black-333 classes" multiple>--}}
                {{--@foreach($programs as $program)--}}
                {{--<option value="{{$program->id}}">{{$program->name}}</option>--}}
                {{--@endforeach()--}}
                {{--</select>--}}
                {{--</div>--}}

                {{--<div class="col-md-6 col-sm-6 col-xs-6 placeholder">--}}
                {{--<select id="subjects" name="ratings" class="form-control black-333 subjects" multiple>--}}
                {{--</select>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Online & Last Login:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6 col-sm-6  placeholder">--}}
                {{--<select id="" name="ratings" class="form-control black-333 online_status">--}}
                {{--<option value="all">Online Status</option>--}}
                {{--<option value="1">Online</option>--}}
                {{--<option value="0">Last login</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--<div class="col-md-6 col-sm-6 placeholder hide last_login">--}}
                {{--<input type="text" name="dates" class="form-control" autocomplete="off" value=""--}}
                {{--placeholder="Last Login"/>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Active</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6  placeholder">--}}
                {{--<select id="" name="ratings" class="form-control black-333 active_record">--}}
                {{--<option value="all">All</option>--}}
                {{--<option value="1">Yes</option>--}}
                {{--<option value="0">No</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col-md-6">
                        <label class="black-333">Commission:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_commission form-control" placeholder="Min" min="0">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_commission form-control" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Revenue Generated:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-6  placeholder">
                                <input type="number" class="min_revenue form-control" placeholder="Min" min="0">
                            </div>
                            <div class="col-md-3 col-sm-6 placeholder">
                                <input type="number" class="max_revenue form-control" placeholder="Max" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Status:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="status" class="form-control black-333 status_record">
                                    <option value="all">Select</option>
                                    <option value="1">Block</option>
                                    <option value="0">Active</option>
                                </select>
                            </div>
                            {{--<div class="col-md-3 col-sm-6  placeholder">--}}
                            {{--<input type="number" class="min_rating form-control" placeholder="Min" min="0">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3 col-sm-6 placeholder">--}}
                            {{--<input type="number" class="max_rating form-control" placeholder="Max" min="0">--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Invoice Status:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="status" class="form-control black-333 invoice_status">
                                    <option value="all">Select</option>
                                    <option value="paid">Paid</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="black-333">Payment Mode:</label>
                        <div class="row">
                            <div class="col-md-6  placeholder">
                                <select id="" name="status" class="form-control black-333 payment_mode">
                                    <option value="all">Select</option>
                                    <option value="cash">Cash</option>
                                    <option value="jazzcash">Jazzcash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Gender:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6  placeholder">--}}
                {{--<select id="" name="ratings" class="form-control black-333 gender_record">--}}
                {{--<option value="all">Select</option>--}}
                {{--<option value="1">Male</option>--}}
                {{--<option value="2">Female</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<label class="black-333">Age:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-3 col-sm-6 placeholder">--}}
                {{--<input type="number" placeholder="Min" class="form-control min_age" min="0" max="100">--}}
                {{--</div>--}}
                {{--<div class="col-md-3 col-sm-6 placeholder">--}}
                {{--<input type="number" placeholder="Max" class="form-control max_age" min="0" max="100">--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6 col-sm-6">--}}
                {{--<label class="black-333">Meet Point:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6 placeholder">--}}
                {{--<select id="" name="ratings" class="form-control black-333 meet_point">--}}
                {{--<option value="all">No Preference</option>--}}
                {{--<option value="0">Call Student</option>--}}
                {{--<option value="1">Go Home</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6 col-sm-6">--}}
                {{--<label class="black-333">Rating filter:</label>--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6 placeholder">--}}
                {{--<select id="ratings" name="ratings" class="form-control black-333">--}}
                {{--<option value="all">All</option>--}}
                {{--<option value="0">0</option>--}}
                {{--<option value="1">1</option>--}}
                {{--<option value="2">2</option>--}}
                {{--<option value="3">3</option>--}}
                {{--<option value="4">4</option>--}}
                {{--<option value="5">5</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3" style="margin-top: 20px; margin-left: 5px; margin-bottom: 20px;">
                            <button class="btn apply-filter" style="background-color: #ab8ce4; color: white"> Apply
                                filter
                            </button>
                        </div>
                    </div>
                </div>
                {{-- End Design By Muhammad Talha Jamshed --}}
                <div class="table-responsive">
                    <br>
                    <br>
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th hidden>id</th>
                            <th>Tutor Name</th>
                            <th>Total Earning</th>
                            <th>Commision</th>
                            <th>Payable</th>
                            <th>Receiveable</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Transaction Type</th>
                            <th>Transaction Platform</th>
                            <th>Transaction Status</th>
                            <th>Commission Percentage</th>
                            <th>Created At</th>
                            {{--                            <th>Approved</th>--}}
                            {{--                            <th>Detail</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        {{--<!-- delete modal content -->--}}
                        {{--<div id="deleteModaltutor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
                        {{--<div class="modal-dialog modal-confirm">--}}
                        {{--<div class="modal-content">--}}
                        {{--<div class="modal-header">--}}
                        {{--<h4 class="modal-title">Delete</h4>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                        {{--<p>Do you really want to delete this tutor?</p>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>--}}
                        {{--<a type="button" class="fcbtn btn btn-danger btn-1d modelDeleteBtn" href="#" style="color: white">Delete</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.modal-dialog -->--}}
                        {{--</div>--}}
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
    @include('admin.includes.filter')
    <script>
		$(document).ready(function () {
			fetch_data();
			$("body").on("click", ".apply-filter", function () {
				var filterDataArray = {};
				$("#myTable").DataTable().clear().destroy();
				//Location data
				if ($(".countries").val() != "")
					filterDataArray["country"] = $(".countries").val();
				if ($(".provinces").val() != "")
					filterDataArray["province"] = $(".provinces").val();
				if ($(".cities").val() != "")
					filterDataArray["city"] = $(".cities").val();
				if ($(".areas").val() != "")
					filterDataArray["area"] = $(".areas").val();

				//Classes and subjects
				if ($(".classes").val() != "")
					filterDataArray["class"] = $(".classes").val();
				if ($(".subjects").val() != "")
					filterDataArray["subject"] = $(".subjects").val();

				//Online Status
				if ($(".online_status").val() != "" && $(".online_status").val() !== "0")
					filterDataArray["online_status"] = $(".online_status").val();
				if ($("input[name=\"dates\"]").val() != "")
					filterDataArray["last_login"] = $("input[name=\"dates\"]").val();


				if ($(".min_commission").val() != "")
					filterDataArray["min_commission"] = $(".min_commission").val();
				if ($(".max_commission").val() != "")
					filterDataArray["max_commission"] = $(".max_commission").val();

				if ($(".min_revenue").val() != "")
					filterDataArray["min_revenue"] = $(".min_revenue").val();
				if ($(".max_revenue").val() != "")
					filterDataArray["max_revenue"] = $(".max_revenue").val();


				if ($(".min_rating").val() != "")
					filterDataArray["min_rating"] = $(".min_rating").val();
				if ($(".max_rating").val() != "")
					filterDataArray["max_rating"] = $(".max_rating").val();
				if ($(".active_record").val() != "")
					filterDataArray["active_record"] = $(".active_record").val();

				if ($(".status_record").val() != "")
					filterDataArray["status_record"] = $(".status_record").val();
				if ($(".invoice_status").val() != "")
					filterDataArray["invoice_status"] = $(".invoice_status").val();

				if ($(".payment_mode").val() != "")
					filterDataArray["payment_mode"] = $(".payment_mode").val();

				if ($(".min_age").val() != "")
					filterDataArray["min_age"] = $(".min_age").val();
				if ($(".max_age").val() != "")
					filterDataArray["max_age"] = $(".max_age").val();

				// Meet Point
				if ($(".meet_point").val() != "")
					filterDataArray["meet_point"] = $(".meet_point").val();

				//Rating Filter
				if ($("#ratings").val() != "")
					filterDataArray["rating"] = $("#ratings").val();

				fetch_data(filterDataArray);
			});
			$("body").on("change", ".online_status", function () {
				var value = $(this).val();
				if (value === "0")
					$(".last_login").removeClass("hide");
				else {
					if ($(".last_login").not(".hide"))
						$(".last_login").addClass("hide");
				}
			});
			function fetch_data(filterDataArray = "") {

				let $mentorOrCommercial = "{{$mentorOrCommercial}}";
				let $table = $("#myTable").DataTable({
					dom: "<\"row\"<\"col-sm-2\"l><\"col-sm-6\"B><\"col-sm-4\"fr>>t<\"row\"<\"col-sm-4\"i><\"col-sm-8\"p>>",
					processing: true,
					searching: true,
					serverSide: true,
					ajax: {
						url: "{{ route('tutorsDisbursements') }}",
						data: {filterDataArray: filterDataArray},
						beforeSend: function () {
							$(".preloader").css("display", "block");
						},
						complete: function (data) {
							$(".preloader").css("display", "none");
						}
					},
					columns: [
						{
							data: "id",
							name: "id"
						},
						{
							data: "tutor",
							name: "tutor.firstName"
						},
						{
							data: "amount",
							name: "amount"
						},
						{
							data: "commission",
							name: "commission"
						},
						{
							data: "payable",
							name: "payable"
						},
						{
							data: "receiveable",
							name: "receiveable"
						},
						{
							data: "due_date",
							name: "due_date"
						},
						{
							data: "status",
							name: "status"
						},
						{
							data: "transaction_type",
							name: "transaction_type"
						},
						{
							data: "transaction_platform",
							name: "transaction_platform"
						},
						{
							data: "transaction_status",
							name: "transaction_status"
						},
						{
							data: "commission_percentage",
							name: "commission_percentage"
						},
						{
							data: "created_at",
							name: "created_at"
						}
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
							extend: "csv",
							className: "btn-md",
							exportOptions: {
								columns: ["0", "1", "2", "3", "4"]
							}
						},
						{
							extend: "excel",
							className: "btn-md",
							exportOptions: {
								columns: ["0", "1", "2", "3", "4"]
							}
						},

						{
							extend: "print",
							className: "btn-md",
							exportOptions: {
								columns: ["0", "1", "2", "3", "4"]
							}
						}
					],
					search: {
						"regex": true
					},
					"bSort": true
				});

			}
		});
        {{--$('body').on('click', '.delete',function (){--}}
        {{--var id = $(this).data('id');--}}
        {{--var href = "{{URL::to('admin/tutor/delete')}}/"+id;--}}
        {{--$('.modelDeleteBtn').attr("href", href);--}}
        {{--$('#deleteModaltutor').modal();--}}
        {{--});--}}
        {{--$('body').on('change.bootstrapSwitch','.js-switch', function(e) {--}}
        {{--var base_url = $(this).data('url');--}}
        {{--var tutor_id = $(this).attr("data-tutor-id");--}}
        {{--$.ajax({--}}
        {{--url:base_url+'/admin/changeTutorStatus',--}}
        {{--type: 'GET',--}}
        {{--data: { tutor_id :tutor_id, is_active: e.target.checked},--}}
        {{--success:function(response){--}}
        {{--console.log(response);--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}
        {{--$('body').on('change.bootstrapSwitch','.is_approved_by_admin', function(e) {--}}
        {{--var base_url = $(this).data('url');--}}
        {{--var tutor_id = $(this).attr("data-tutor-id");--}}
        {{--$.ajax({--}}
        {{--url:base_url+'/admin/changeTutorApprovedStatus',--}}
        {{--type: 'GET',--}}
        {{--data: { tutor_id :tutor_id, is_approved: e.target.checked},--}}
        {{--success:function(response){--}}
        {{--console.log(response);--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}

    </script>
@stop
