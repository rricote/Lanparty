@extends('web.sidebar')

@section('side')
    <!-- CONTENT BODY - START -->
    <div class="col-sm-8">

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
                                <h2>{{ $grup->name }}</h2>
                                <?php $i2 = 0; ?>
                                <ul class="list-unstyled">
                                    @foreach($grup->competicionsusersgrups as $c)
                                        <?php $i2++; ?>
                                        <li><p>{{ $c->user->name }} <b>{{ $c->user->username }}</b> {{ $c->user->cognom1 }}</p></li>
                                    @endforeach
                                    @for($i = 0; $i < $i2; $i++)
                                            <li><p>Lloc disponible</p></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GAMING TEAM INFO - START -->
        @endif

    </div>
    <!-- CONTENT BODY - END -->
@endsection