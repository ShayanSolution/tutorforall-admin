@extends('admin.layout')
@section('title','Map')

@section('styles')
    <style>
        #map {
            height: 500px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Map</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Map</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box col-md-12">
                <h2>Tutors By Coordinates</h2>
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 31.511464, lng: 74.345397}
            });

            var iconPath = '/admin_assets/images/marker_image.png';

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = tutors.map(function(tutor, i) {

                var contentString = '<div id="content">'+
                    '<h2>'+tutor.fullName+'</h2>' +
                    '<div>'+tutor.phone+'</div>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                let marker = new google.maps.Marker({
                    position: tutor,
                    icon: iconPath,
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

                return marker;
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: '//developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        var tutors = {!! json_encode($tutors) !!};
    </script>
    <script src="//developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_api_key')}}&callback=initMap">
    </script>
@endsection
