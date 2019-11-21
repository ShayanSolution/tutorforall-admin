<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin @yield('title')</title>
    @include('admin.includes.stylesheets')
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