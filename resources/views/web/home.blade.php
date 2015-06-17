@extends('web.home_sidebar')

@section('homeContent')
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
                                    @if($n['notification']->state != 1)
                                        <li>
                                            <div style="border-top: 1px solid #bce8f1; padding: 10px 0px;">
                                                <a style="margin-left: 2px;" target="_blank" href="{{url('perfil/' . $n['user']->id)}}">{{ $n['user']->username }}</a>
                                                &nbsp;vol entrar a&nbsp;
                                                <a style="margin: 0px;" target="_blank" href="{{url('group/' . $n['group']->id)}}">{{ $n['group']->name }}</a>
                                                &nbsp;de&nbsp;
                                                <a style="margin: 0px;" target="_blank" href="{{url('competicio/' . $n['group']->competicio->id)}}">{{ $n['group']->competicio->name }}</a>
                                    <span style="float: right;">
                                        @if($n['notification']->state == 2 || $n['notification']->state == 0)
                                            {!! Form::open(array('url' => 'notification/equip/acceptar/' . $n['notification']->id, 'style'=>'display: inline;')) !!}
                                            <input type="hidden" name="url" value="{{ Request::url() }}">
                                            <button style="margin: 0px 2px;" type="submit" class="btn btn-success">Acceptar</button>
                                            {!! Form::close() !!}
                                        @endif
                                        {!! Form::open(array('url' => 'notification/equip/cancelar/' . $n['notification']->id, 'style' => 'display: inline;')) !!}
                                        <input type="hidden" name="url" value="{{ Request::url() }}">
                                        <button style="margin: 0px 2px;" type="submit" class="btn btn-danger">@if($n['notification']->state == 3) Descancel·lar @else Cancel·lar @endif</button>
                                        {!! Form::close() !!}
                                        @if($n['notification']->state == 2 || $n['notification']->state == 0)
                                            {!! Form::open(array('url' => 'notification/equip/llegida/' . $n['notification']->id, 'style' => 'display: inline;')) !!}
                                            <input type="hidden" name="url" value="{{ Request::url() }}">
                                            <button style="margin: 0px 2px;" type="submit" class="btn btn-info">@if($n['notification']->estat == 2) Desmarcar llegida @else Marcar llegida @endif</button>
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box sidebar-box widget-wrapper">
                        <ul class="nav nav-sidebar">
                            <h2>Benvingut a la lan party</h2>
                            @if (!Auth::guest())
                                <div style="text-align: center;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{urlencode(url('registre/user/' . Auth::user()->ultratoken)) }}" style="max-height: 600px;"></div>
                            @else
                                <p>Pots <a href="{{ url('auth/register') }}">crear</a> un compte nou o <a href="{{ url('auth/login') }}">accedir</a> si ja estas registrat per a poder apuntar-te als direfents tornejos:</p>
                            @endif
                        </ul>
                    </div>

                    <div class="box sidebar-box widget-wrapper">
                        <h2>Enllaços d'interes</h2>
                        <div style="text-align: center;">
                            <a style="margin:10px; min-width: 120px;" href="{{url('competicions')}}" class="btn btn-primary">Competicions</a>
                            <a style="margin:10px; min-width: 120px;" href="{{url('colaboradors')}}" class="btn btn-primary">Col·laboradors</a>
                            <a style="margin:10px; min-width: 120px;" href="{{url('premis')}}" class="btn btn-primary">Premis</a>
                            <a style="margin:10px; min-width: 120px;" href="{{url('cartell')}}" class="btn btn-primary">Cartell</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection