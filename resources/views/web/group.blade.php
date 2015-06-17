@extends('web.sidebar')

@section('side')
    <!-- CONTENT BODY - START -->
    <div class="col-xs-12 col-sm-8">

        @if($id == null)
            <div class="box sidebar-box widget-wrapper">
                <h3>Grups</h3>
                <ul class="nav nav-sidebar">
                    @foreach($group as $g)
                        <li><a href="{{ url('group/' . $g['id']) }}">{{ $g['name'] }}<span>{{ $g['count'] }}</span></a></li>
                    @endforeach
                </ul>
            </div>
        @else
            <!-- GAMING TEAM INFO - START -->
            <div class="box gaming-team">
                <div class="row">
                    <div class="col-md-3 col-xs-4">
                        <img src="{{ url('images/competitions/' . $group->competition->imatge) }}" alt="competition{{ $group->id }}" class="img-responsive center-block">
                    </div>
                    <div class="col-md-9 col-xs-8">
                        <h2>{{ $group->competition->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-match">
                            <div class="lineup left">
                                <h3>{{ $group->name }}</h3>
                                <?php $i2 = 0; ?>
                                <ul class="list-unstyled">
                                    @foreach($group->competitionsusersgroups as $c)
                                        <?php $i2++; ?>
                                        <li><p>{{ $c->user->name }} <b>{{ $c->user->username }}</b> {{ $c->user->surname1 }}</p></li>
                                    @endforeach
                                    @for($i = 0; $i < $group->competition->number - $i2; $i++)
                                        <li><p>Lloc disponible</p></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($notifications))
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Peticions d'entrada</h2>
                        <ul class="nav nav-sidebar">
                            @foreach($notifications as $n)
                                @if($n['notification']->state != 1)
                                <li>
                                    <div>
                                        <a style="margin-left: 10px;" target="_blank" href="{{url('perfil/' . $n['user']->id)}}">{{ $n['user']->username }}</a>
                                        <span style="float: right;">
                                            @if($n['notification']->state == 2 || $n['notification']->state == 0)
                                                {!! Form::open(array('url' => 'notification/equip/acceptar/' . $n['notification']->id, 'style'=>'display: inline;')) !!}
                                                <button style="margin: 0px 10px;" type="submit" class="btn btn-success">Acceptar</button>
                                                {!! Form::close() !!}
                                            @endif
                                            {!! Form::open(array('url' => 'notification/equip/cancelar/' . $n['notification']->id, 'style' => 'display: inline;')) !!}
                                            <button style="margin: 0px 10px;" type="submit" class="btn btn-danger">@if($n['notification']->state == 3) Descancel·lar @else Cancel·lar @endif</button>
                                            {!! Form::close() !!}
                                            @if($n['notification']->state == 2 || $n['notification']->state == 0)
                                                {!! Form::open(array('url' => 'notification/equip/llegida/' . $n['notification']->id, 'style' => 'display: inline;')) !!}
                                                <button style="margin: 0px 10px;" type="submit" class="btn btn-info">@if($n['notification']->state == 2) Desmarcar llegida @else Marcar llegida @endif</button>
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