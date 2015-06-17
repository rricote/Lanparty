@extends('web.sidebar')

@section('side')

    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="box sidebar-box widget-wrapper">
            <h4>Tens aquestes notificacions:<a class="anchorjs-link"><span class="anchorjs-icon"></span></a></h4>

            <ul class="list-unstyled" style="margin-bottom: 20px;">
                @foreach($notifications as $n)
                        <li>
                            @if($n['notification']->state == 0 || $n['notification']->state == 2)
                            <div style="border-top: 1px solid #EFEFEF; padding: 10px 0px; height: 66px;">
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
                                        <button style="margin: 0px 2px;" type="submit" class="btn btn-info">@if($n['notification']->state == 2) Desmarcar llegida @else Marcar llegida @endif</button>
                                        {!! Form::close() !!}
                                    @endif
                                </span>
                            </div>
                            @endif
                        </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection