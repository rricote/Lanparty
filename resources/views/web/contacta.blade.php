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
                <div class="tournament">
                    <h4>Contacta</h4>
                    <h3>Sobre nosaltres:</h3>
                    <p>{{ $config->descripcio }}</p>
                    <h3>E-mail:</h3>
                    <p>{{ $config->email }}</p>
                    <h3>Hora d'inici:</h3>
                    <?php
                    list($date, $time) = explode(' ',$config->data_inici);
                    list($any, $mes, $dia) = explode('-', $date);
                    list($hora, $minuts, $segons) = explode(':', $time);
                    ?>
                    <div style="font-size: 24px; margin-bottom: 20px;">{{ $dia . '-' .  $mes . '-' . $any . ' a les ' . $hora . ':' . $minuts }}</div>
                    <h3>Direcció:</h3>
                    <p>{{ $config->direccio }}</p>
                    <div>
                        <div style="width: 100%; height: 500px;" id="map-canvas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection