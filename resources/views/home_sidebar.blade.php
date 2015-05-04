@extends('app')

@section('content')

    <!-- ==========================
    	JUMBOTRON - START
    =========================== -->
    <div class="container">
        <div class="jumbotron">
            <div class="jumbotron-panel">
                <div class="panel panel-primary collapse-horizontal">
                    <a data-toggle="collapse" class="btn btn-primary collapsed" data-target="#toggle-collapse">Check our Servers <i class="fa fa-caret-down"></i></a>
                    <div class="jumbotron-brands">
                        <ul class="brands brands-sm brands-inline brands-circle">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-twitch"></i></a></li>
                            <li><a href=""><i class="fa fa-steam"></i></a></li>
                        </ul>
                    </div>
                    <div id="toggle-collapse" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered table-header">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>IP Address</th>
                                    <th>Map</th>
                                    <th>Players</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/icons/csgo.jpg" alt=""></td>
                                    <td>[EU] CS:GO #1 | pixelized.cz</td>
                                    <td>123.221.45.12:29999</td>
                                    <td>de_dust2</td>
                                    <td>18/18</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/csgo.jpg" alt=""></td>
                                    <td>[CZ/SK] CS:GO Public | pixelized.cz</td>
                                    <td>45.184.170.200:27851</td>
                                    <td>de_inferno</td>
                                    <td>24/32</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/lol.png" alt=""></td>
                                    <td>[EU] League of Legends</td>
                                    <td>50.243.180.246:25429</td>
                                    <td>normal</td>
                                    <td>10/30</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/gta.png" alt=""></td>
                                    <td>[EU] GTA Server</td>
                                    <td>132.24.45.83:27852</td>
                                    <td>classic</td>
                                    <td>22/60</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="jumbotron-slider">

                <!-- JUMBOTRON ITEM - START -->
                <div class="item">
                    <a href="single.html">
                        <div class="overlay-wrapper">
                            <img src="assets/images/image_001.jpg" class="img-responsive" alt="">
                            <span class="overlay"></span>
                            <h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>
                        </div>
                    </a>
                </div>
                <!-- JUMBOTRON ITEM - END -->

                <!-- JUMBOTRON ITEM - START -->
                <div class="item">
                    <a href="single.html">
                        <div class="overlay-wrapper">
                            <img src="assets/images/image_002.jpg" class="img-responsive" alt="">
                            <span class="overlay"></span>
                            <h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>
                        </div>
                    </a>
                </div>
                <!-- JUMBOTRON ITEM - END -->

                <!-- JUMBOTRON ITEM - START -->
                <div class="item">
                    <a href="single.html">
                        <div class="overlay-wrapper">
                            <img src="assets/images/image_003.jpg" class="img-responsive" alt="">
                            <span class="overlay"></span>
                            <h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>
                        </div>
                    </a>
                </div>
                <!-- JUMBOTRON ITEM - END -->

                <!-- JUMBOTRON ITEM - START -->
                <div class="item">
                    <a href="single.html">
                        <div class="overlay-wrapper">
                            <img src="assets/images/image_004.jpg" class="img-responsive" alt="">
                            <span class="overlay"></span>
                            <h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>
                        </div>
                    </a>
                </div>
                <!-- JUMBOTRON ITEM - END -->

                <!-- JUMBOTRON ITEM - START -->
                <div class="item">
                    <a href="single.html">
                        <div class="overlay-wrapper">
                            <img src="assets/images/image_005.jpg" class="img-responsive" alt="">
                            <span class="overlay"></span>
                            <h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>
                        </div>
                    </a>
                </div>
                <!-- JUMBOTRON ITEM - END -->

            </div>
        </div>
    </div>
    <!-- ==========================
    	JUMBOTRON - END
    =========================== -->

    @yield('homeContent')

@endsection
