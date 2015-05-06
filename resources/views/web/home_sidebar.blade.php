@extends('web.app')

@section('content')

    <!-- ==========================
    	JUMBOTRON - START
    =========================== -->
    <div class="container">
        <div class="jumbotron">
            <div class="jumbotron-panel">
                <div class="panel panel-primary collapse-horizontal">
                    <a data-toggle="collapse" class="btn btn-primary collapsed" data-target="#toggle-collapse">Inscriure's a un torneig <i class="fa fa-caret-down"></i></a>
                    <div class="jumbotron-brands">
                        <ul class="brands brands-sm brands-inline brands-circle">
                            <li><a target="_blank" href="https://www.facebook.com/LanPartyIesEbre"><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <!--<li><a href=""><i class="fa fa-twitch"></i></a></li>
                            <li><a href=""><i class="fa fa-steam"></i></a></li>-->
                        </ul>
                    </div>
                    <div id="toggle-collapse" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered table-header">
                                @if (Auth::guest())
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($competi as $c)
                                    <tr>
                                        <td><img src="{{asset('/icons/competicions/' . $c['logo'])}}" alt=""></td>
                                        <td>{{$c['nom']}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom</th>
                                        <th>Inscriure's</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($competi as $c)
                                        <tr>
                                            <td><img src="{{asset('/icons/competicions/' . $c['logo'])}}" alt=""></td>
                                            <td>{{$c['nom']}}</td>
                                            <td>
                                                @if ($c['triat'])
                                                    <label>{{$c['id']}}</label>
                                                    <input type="checkbox" checked>
                                                @else
                                                    <label>{{$c['id']}}</label>
                                                    <input type="checkbox">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                            <img src="{{ asset('/images/image_001.jpg')}}" class="img-responsive" alt="">
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
                            <img src="{{ asset('/images/image_002.jpg')}}" class="img-responsive" alt="">
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
                            <img src="{{ asset('/images/image_003.jpg')}}" class="img-responsive" alt="">
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
                            <img src="{{ asset('/images/image_004.jpg')}}" class="img-responsive" alt="">
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
                            <img src="{{ asset('/images/image_005.jpg')}}" class="img-responsive" alt="">
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
