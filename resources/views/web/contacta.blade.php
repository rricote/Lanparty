@extends('web.sidebar')

@section('side')
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var mapCanvas = document.getElementById('map-canvas');
            var mapOptions = {
                center: new google.maps.LatLng(40.815105, 0.515501),
                zoom: 17,
                //mapTypeId: google.maps.MapTypeId.ROADMAP
                mapTypeId: google.maps.MapTypeId.HYBRID
                //mapTypeId: google.maps.MapTypeId.SATELLITE
                //mapTypeId: google.maps.MapTypeId.TERRAIN
            }
            var map = new google.maps.Map(mapCanvas, mapOptions)
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="box sidebar-box widget-wrapper">
            <div>
                <div style="width: 100%; height: 500px;" id="map-canvas"></div>
            </div>

            <div>
                asdfds
            </div>

        </div>
    </div>
@endsection