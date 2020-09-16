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
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Online Status</option>
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
                                <input type="number" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Max" style="width: 50px">
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
                                <input type="number" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Max" style="width: 50px">
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
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
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
                                <select id="" name="ratings" class="form-control black-333" style="margin-left: 0px; float: right; height: 25px; font-size: x-small; padding: 0;">
                                    <option value="all">Select</option>
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
                                <input type="number" placeholder="Min" style="width: 50px">
                            </div>
                            <div class="col-md-1  placeholder" style="padding: 0; margin-right: 10px; width: 50px">
                                <input type="number" placeholder="Max" style="width: 50px">
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

                    <div class="col-md-3" style="margin-top: 20px; margin-left: 5px">
                        <button class="btn" style="background-color: #ab8ce4; color: white"> Apply filter</button>
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
                        @foreach($tutors as $tutor)
                            <tr>
                                <td hidden>{{$tutor->id}}</td>
                                <td>{{$tutor->firstName ? $tutor->firstName : 'N-A'}}</td>
                                <td>{{$tutor->lastName ? $tutor->lastName : 'N-A'}}</td>
                                <td>{{$tutor->email}}</td>
                                <td>{{$tutor->phone}}</td>
                                <td>{{round($tutor->rating->avg('rating'),1)}}</td>
                                <td>{{dateTimeConverter($tutor->created_at)}}</td>
                                <td>{{$tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login)}}</td>
                                {{--<td>@if($tutor->is_active == 1) Yes @else No @endif</td>--}}
                                <td><input type="checkbox" data-tutor-id="{{ $tutor->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($tutor->is_active == 1) checked @endif></td>
                                <td><input type="checkbox" data-tutor-id="{{ $tutor->id }}" data-url="{{url('/')}}" class="is_approved_by_admin" data-color="#99d683" @if($tutor->is_approved == 1) checked @endif></td>
                                <td><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="{{route('tutorProfile',$tutor->id)}}" alt="default">View</a></td>
                                <td><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModaltutor{{$tutor->id}}">Delete</a></td>
                            </tr>

                            <!-- delete modal content -->
                            <div id="deleteModaltutor{{$tutor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('tutorDelete',$tutor->id)}}" style="color: white">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        @endforeach
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
            let table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-8"B><"col-sm-4"fr>>t<"row"<"col-sm-2"l><"col-sm-10"p>>',
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
                "bSort": true
            });

            // Event listener to the two range filtering inputs to redraw on input
            $('#ratings').change(function() {
                table.draw();
            });
        });
        $('.js-switch').on('change.bootstrapSwitch', function(e) {
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
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
            var base_url = $(this).data('url');
        });

        $('.is_approved_by_admin').on('change.bootstrapSwitch', function(e) {
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
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.is_approved_by_admin'));
        $('.is_approved_by_admin').each(function () {
            new Switchery($(this)[0], $(this).data());
            var base_url = $(this).data('url');
        });
    </script>
@stop
<style>
    .black-333{
        color: #333333;
    }
</style>
