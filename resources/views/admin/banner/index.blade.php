@extends('admin.layout')
@section('title','BannersList')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Banners List</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Banners List</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                    <a type="button" class="btn btn-block btn-primary" href="{{route('banners.create')}}">Create Banner</a>
                </div>
                <h3 class="box-title m-b-0">Banners List Details</h3>
                <hr>
                <div class="table-responsive">
                    <table id="bannerTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>HyperLink</th>
                            <th>Image</th>
                            <th>Sent Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                @if($banner->hyperlink)
                                <td><a target="_blank" href={{$banner->hyperlink}}>Banner Link</a></td>
                                @else
                                <td>No Banner Link</td>
                                @endif
                                <td><a target="_blank" href={{ $banner->path }}>Banner Image</a></td>
                                <td>{{dateTimeConverter($banner->created_at)}}</td>
                            </tr>
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
            $('#bannerTable').DataTable({
                // dom: '<"row"<"col-sm-8"B><"col-sm-4"fr>>t<"row"<"col-sm-2"l><"col-sm-10"p>>',
                // buttons: [
                //     { extend: 'csv', className: 'btn-md', exportOptions: {
                //             columns: ['0', '1', '2', '3', '4'],
                //         } },
                //     { extend: 'excel', className: 'btn-md', exportOptions: {
                //             columns: ['0','1', '2', '3', '4'],
                //         } },
                //     { extend: 'print', className: 'btn-md', exportOptions: {
                //             columns: ['0','1', '2', '3', '4'],
                //         } }
                // ],
                "bSort": true
            });
        });
    </script>
@stop
