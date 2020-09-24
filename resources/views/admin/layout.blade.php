<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin @yield('title')</title>
    @include('admin.includes.stylesheets')
    @yield('styles')
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    @include('admin.includes.header')
    @include('admin.includes.sidebar')
    <div id="page-wrapper">
    @yield('content')
    @include('admin.includes.footer')
    </div>
    @section('javascripts')
        @include('admin.includes.javascripts')
        <script src="{{url('admin_assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('/admin_assets/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
        <script src="{{url('/admin_assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>

        <script src="{{url('/admin_assets/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{url('/admin_assets/datatables/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{url('/admin_assets/js/location.js')}}"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <script>
            function hideAndShowFullOrSmallLogo() {
                $('.logo-full').hide();
                $('.logo-small').hide();
                setTimeout(function () {
                    showFullOrSmallLogo();
                }, 50);
            }

            function showFullOrSmallLogo(){
                if($('.open-close > i').attr('class') === 'ti-menu'){
                    $('.logo-small').show();
                }else{
                    $('.logo-full').show();
                }
            }

            $('.open-close').on('click', function () {
                hideAndShowFullOrSmallLogo()
            });

            $(document).ready(function () {
                setTimeout(function () {
                    hideAndShowFullOrSmallLogo()
                }, 1000);
            });
        </script>
    @show
</div>
</body>
</html>
