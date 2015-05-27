@extends('web.app')

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
                    @if($competicio)
                    <h3>Proxim torneig</h3>
                    <div class="tournament">
                        <a href="{{ url('competicio/' . $competicio->id) }}"><img src="{{asset('/images/competicions/' . $competicio->imatge)}}" class="img-responsive" alt=""></a>
                        <h4>{{ $competicio->name }}</h4>
                        <?php
                        list($date, $time) = explode(' ',$competicio->data_inici);
                        list($any, $mes, $dia) = explode('-', $date);
                        list($hora, $minuts, $segons) = explode(':', $time);
                        ?>
                        <div class="date">{{ $dia . '-' .  $mes . '-' . $any . ' a les ' . $hora . ':' . $minuts}}</div>
                        <div class="text-center"><a href="{{ url('competicio/' . $competicio->id) }}" class="btn btn-primary">Més informació</a></div>
                    </div>
                    @else
                        <h3>No queden més competicions</h3>

                        <div class="tournament">
                            <div class="date">:-(</div>
                        </div>
                    @endif
                </div>
                <!-- SIDEBAR BOX - END -->

                <!-- SIDEBAR BOX - START -->
                <div class="box sidebar-box widget-wrapper">
                    <h3>Competicions</h3>

                    <ul class="nav nav-sidebar">
                        @foreach($competicions as $c)
                            <li><a href="{{ url('competicio/' . $c['id']) }}"><img style="width: 35px;" src="{{asset('/icons/competicions/' . $c['logo'])}}" alt="competicio{{ $c['id'] }}">    {{ $c['name'] }}<span>{{ $c['count'] }}</span></a></li>
                        @endforeach
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