@extends('web.sidebar')

@section('side')
    <!-- CONTENT BODY - START -->
    <div class="col-xs-12 col-sm-8">

        @if($id == null)
            <div class="box sidebar-box widget-wrapper">
                <h3>Grups</h3>
                <ul class="nav nav-sidebar">
                    @foreach($grup as $g)
                        <li><a href="{{ url('grup/' . $g['id']) }}">{{ $g['name'] }}<span>{{ $g['count'] }}</span></a></li>
                    @endforeach
                </ul>
            </div>
        @else
            <!-- GAMING TEAM INFO - START -->
            <div class="box gaming-team">
                <div class="row">
                    <div class="col-md-3 col-xs-4">
                        <img src="{{ url('images/competicions/' . $grup->competicio->imatge) }}" alt="competicio{{ $grup->id }}" class="img-responsive center-block">
                    </div>
                    <div class="col-md-9 col-xs-8">
                        <h2>{{ $grup->competicio->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-match">
                            <div class="lineup left">
                                <h3>{{ $grup->name }}</h3>
                                <?php $i2 = 0; ?>
                                <ul class="list-unstyled">
                                    @foreach($grup->competicionsusersgrups as $c)
                                        <?php $i2++; ?>
                                        <li><p>{{ $c->user->name }} <b>{{ $c->user->username }}</b> {{ $c->user->cognom1 }}</p></li>
                                    @endforeach
                                    @for($i = 0; $i < $grup->competicio->number - $i2; $i++)
                                        <li><p>Lloc disponible</p></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($notificacions))
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Peticions d'entrada</h2>
                        <ul class="nav nav-sidebar">
                            @foreach($notificacions as $n)
                                @if($n['notificacio']->estat != 1)
                                <li>
                                    <div>
                                        <a style="margin-left: 10px;" target="_blank" href="{{url('perfil/' . $n['user']->id)}}">{{ $n['user']->username }}</a>
                                        <span style="float: right;">
                                            @if($n['notificacio']->estat == 2 || $n['notificacio']->estat == 0)
                                                {!! Form::open(array('url' => 'notificacio/equip/acceptar/' . $n['notificacio']->id, 'style'=>'display: inline;')) !!}
                                                <button style="margin: 0px 10px;" type="submit" class="btn btn-success">Acceptar</button>
                                                {!! Form::close() !!}
                                            @endif
                                            {!! Form::open(array('url' => 'notificacio/equip/cancelar/' . $n['notificacio']->id, 'style' => 'display: inline;')) !!}
                                            <button style="margin: 0px 10px;" type="submit" class="btn btn-danger">@if($n['notificacio']->estat == 3) Descancel·lar @else Cancel·lar @endif</button>
                                            {!! Form::close() !!}
                                            @if($n['notificacio']->estat == 2 || $n['notificacio']->estat == 0)
                                                {!! Form::open(array('url' => 'notificacio/equip/llegida/' . $n['notificacio']->id, 'style' => 'display: inline;')) !!}
                                                <button style="margin: 0px 10px;" type="submit" class="btn btn-info">@if($n['notificacio']->estat == 2) Desmarcar llegida @else Marcar llegida @endif</button>
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
            </div>
            <!-- GAMING TEAM INFO - START -->
        @endif

    </div>
    <!-- CONTENT BODY - END -->
@endsection