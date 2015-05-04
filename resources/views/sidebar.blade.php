@extends('app')

@section('content')
<!-- ==========================
    CONTENT - START
=========================== -->
<div class="container">
    <section class="content-wrapper">
        <div class="row">

            <!-- SIDEBAR - START -->
            <div class="col-sm-4 hidden-xs">

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper">
                    <h3>Upcoming tournament</h3>
                    <div class="tournament">
                        <a href="tournament.html"><img src="{{ asset('/images/esl.png')}}" class="img-responsive" alt=""></a>
                        <h4>ESL 2015</h4>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus.</p>
                        <div class="date">21 - 29 June 2015</div>
                        <div class="text-center"><a href="tournament.html" class="btn btn-primary">More info</a></div>
                    </div>
                </div>
                <!-- SIDEBAR BOX - END -->

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper widget-matches">
                    <h3>Upcoming matches <a href="matches-list.html" class="btn btn-primary pull-right btn-sm">All matches</a></h3>

                    <a href="match-single.html">
                        <table class="table match-wrapper">
                            <tbody>
                            <tr>
                                <td class="game">
                                    <img src="{{ asset('/icons/dota2.png')}}" alt="">
                                    <span>Dota 2</span>
                                </td>
                                <td class="game-date">
                                    <span>5/10/2015 - 19:30</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/cze.png')}}" alt="">Czech Republic</td>
                                <td class="team-score">-</td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/swe.png')}}" alt="">Sweden</td>
                                <td class="team-score">-</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>

                    <a href="match-single.html">
                        <table class="table match-wrapper">
                            <tbody>
                            <tr>
                                <td class="game">
                                    <img src="{{ asset('/icons/csgo.jpg')}}" alt="">
                                    <span>CS GO</span>
                                </td>
                                <td class="game-date">
                                    <span>22/11/2015 - 22:00</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/den.png')}}" alt="">Fnatic</td>
                                <td class="team-score">-</td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/swe.png')}}" alt="">Ninjas in Pyjamas</td>
                                <td class="team-score">-</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <!-- SIDEBAR BOX - END -->

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper widget-matches">
                    <h3>Latest matches <a href="matches-list.html" class="btn btn-primary pull-right btn-sm">All matches</a></h3>

                    <a href="match-single.html">
                        <table class="table match-wrapper">
                            <tbody>
                            <tr>
                                <td class="game">
                                    <img src="{{ asset('/icons/lol.png')}}" alt="">
                                    <span>LoL</span>
                                </td>
                                <td class="game-date">
                                    <span>18/02/2015 - 14:00</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/usa.png')}}" alt=""><b>Ninjas in Pyjamas</b></td>
                                <td class="team-score win">9</td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/den.png')}}" alt="">Natus Vincere</td>
                                <td class="team-score lose">5</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>

                    <a href="match-single.html">
                        <table class="table match-wrapper">
                            <tbody>
                            <tr>
                                <td class="game">
                                    <img src="{{ asset('/icons/gta.png')}}" alt="">
                                    <span>GTA</span>
                                </td>
                                <td class="game-date">
                                    <span>8/6/2015 - 12:00</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/swe.png')}}" alt=""><b>Ninjas in Pyjamas</b></td>
                                <td class="team-score win">9</td>
                            </tr>
                            <tr>
                                <td class="team-name"><img src="{{ asset('/icons/usa.png')}}" alt="">Natus Vincere</td>
                                <td class="team-score lose">5</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <!-- SIDEBAR BOX - END -->

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper">
                    <h3>Categories</h3>
                    <ul class="nav nav-sidebar">
                        <li><a href="#">Tournaments<span>45</span></a></li>
                        <li><a href="#">Leagues<span>122</span></a></li>
                        <li><a href="#">Counter Strike<span>684</span></a></li>
                        <li><a href="#">Dota 2<span>1242</span></a></li>
                        <li><a href="#">World of Warcraft<span>112</span></a></li>
                        <li><a href="#">Minecraft<span>18</span></a></li>
                    </ul>
                </div>
                <!-- SIDEBAR BOX - END -->

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper">
                    <h3>Latest Tweets</h3>
                    <div id="twitter-wrapper">
                    </div>
                </div>
                <!-- SIDEBAR BOX - END -->

            </div>
            <!-- SIDEBAR - END -->

            @yield('side')

        </div>
    </section>
</div>
<!-- ==========================
    CONTENT - END
=========================== -->
@endsection