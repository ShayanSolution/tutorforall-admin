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
    @show
</div>
</body>
</html>