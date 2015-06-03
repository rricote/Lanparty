@extends('web.app')

@section('content')
<!-- ==========================
    CONTENT - START
=========================== -->
<div class="container">
    <section class="content-wrapper">
        <div class="row">
            @if(isset($not))
            <div class="col-xs-12 col-sm-12">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4>Tens aquestes notificacions:<a class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>

                    <ul class="list-unstyled" style="margin-bottom: 20px;">
                    @foreach($not as $n)
                        @if($n['notificacio']->estat != 1)
                            <li>
                                <div style="border-top: 1px solid #bce8f1; padding: 10px 0px;">
                                    <a style="margin-left: 2px;" target="_blank" href="{{url('perfil/' . $n['user']->id)}}">{{ $n['user']->username }}</a>
                                    &nbsp;vol entrar a&nbsp;
                                    <a style="margin: 0px;" target="_blank" href="{{url('grup/' . $n['grup']->id)}}">{{ $n['grup']->name }}</a>
                                    &nbsp;de&nbsp;
                                    <a style="margin: 0px;" target="_blank" href="{{url('competicio/' . $n['grup']->competicio->id)}}">{{ $n['grup']->competicio->name }}</a>
                                    <span style="float: right;">
                                        @if($n['notificacio']->estat == 2 || $n['notificacio']->estat == 0)
                                            {!! Form::open(array('url' => 'notificacio/equip/acceptar/' . $n['notificacio']->id, 'style'=>'display: inline;')) !!}
                                            <input type="hidden" name="url" value="{{ Request::url() }}">
                                            <button style="margin: 0px 2px;" type="submit" class="btn btn-success">Acceptar</button>
                                            {!! Form::close() !!}
                                        @endif
                                        {!! Form::open(array('url' => 'notificacio/equip/cancelar/' . $n['notificacio']->id, 'style' => 'display: inline;')) !!}
                                        <input type="hidden" name="url" value="{{ Request::url() }}">
                                        <button style="margin: 0px 2px;" type="submit" class="btn btn-danger">@if($n['notificacio']->estat == 3) Descancel·lar @else Cancel·lar @endif</button>
                                        {!! Form::close() !!}
                                        @if($n['notificacio']->estat == 2 || $n['notificacio']->estat == 0)
                                            {!! Form::open(array('url' => 'notificacio/equip/llegida/' . $n['notificacio']->id, 'style' => 'display: inline;')) !!}
                                            <input type="hidden" name="url" value="{{ Request::url() }}">
                                            <button style="margin: 0px 2px;" type="submit" class="btn btn-info">@if($n['notificacio']->estat == 2) Desmarcar llegida @else Marcar llegida @endif</button>
                                            {!! Form::close() !!}
                                        @endif
                                    </span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
            @endif
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