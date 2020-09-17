@extends('admin.layout')
@section('title','categoriesList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Categories List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Categories List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('categoryAdd')}}">Add Category</a>
                </div>
                <h3 class="box-title m-b-0">Categories List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Active</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{dateTimeConverter($category->created_at)}}</td>
                                <td data-filter="@if($category->status != 1) No @else Yes @endif"><input type="checkbox" data-category-id="{{ $category->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($category->status == 1) checked @endif></td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-info btn-outline btn-1d" href="{{route('categoryEdit',$category->id)}}">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModal{{$category->id}}">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <!-- delete modal content -->
                            <div id="deleteModal{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete this category?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('categoryDelete',$category->id)}}" style="color: white">Delete</a>
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

    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                dom: '<"row"<"col-sm-8"B><"col-sm-4"fr>>t<"row"<"col-sm-2"l><"col-sm-10"p>>',
                buttons: [
                    { extend: 'csv', className: 'btn-md', exportOptions: {
                            columns: ['0'],
                        } },
                    { extend: 'excel', className: 'btn-md', exportOptions: {
                            columns: ['0'],
                        } },
                    { extend: 'print', className: 'btn-md', exportOptions: {
                            columns: ['0'],
                        } }
                ],
                "bSort": true
            });

            $("#myTable tfoot th").each( function ( i ) {

                if ($(this).text() !== '' && $(this).text() === 'Active' ) {
                    var isActiveColumn = (($(this).text() == 'Active') ? true : false);
                    var select = $('<select class="filter_search"><option value="">All</option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $(this).val();

                            table.column( i )
                                .search( val ? '^'+$(this).val()+'$' : val, true, false )
                                .draw();
                        } );

                    // Get the Status values a specific way since the status is a anchor/image
                    if (isActiveColumn) {
                        var activeItems = [];

                        /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
                        table.column( i ).nodes().to$().each( function(d, j){
                            var thisStatus = $(j).attr("data-filter");
                            if($.inArray(thisStatus, activeItems) === -1) activeItems.push(thisStatus);
                        } );

                        activeItems.sort();

                        $.each( activeItems, function(i, item){
                            select.append( '<option value="'+item+'">'+item+'</option>' );
                        });

                    }
                    // All other non-Status columns (like the example)
                    else {
                        table.column( i ).data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' );
                        } );
                    }

                }
            } );
        });

        $('.js-switch').on('change.bootstrapSwitch', function(e) {
            var base_url = $(this).data('url');
            var category_id = $(this).attr("data-category-id");
            $.ajax({
                url:base_url+'/admin/changeCategoryStatus',
                type: 'GET',
                data: {category_id :category_id, status: e.target.checked},
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
    </script>
@stop
