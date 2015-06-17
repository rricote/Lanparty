@extends('web.sidebar')

@section('side')

    <!-- CONTENT BODY - START -->
    <div class="col-sm-8">
        <div class="box">

            <!-- TEAM MEMBER - START -->
            <div class="team-member single">
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <ul class="brands brands-tn brands-circle brands-colored brands-inline text-center">
                            <li><a href="https://www.facebook.com/pixelized.cz" target="_blank" class="brands-facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/Pixelizedcz" target="_blank" class="brands-twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/+PixelizedCz/" target="_blank" class="brands-google-plus"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-8 col-md-9">
                        <h2>Usuari nickname: <small>{{ $user->username }}</small></h2>
                        <ul class="list-unstyled">
                            <li><strong>Membre des de:</strong>{{ $inici }}</li>
                            @if(!$public)
                                <li><strong>Perfil public:</strong><a href="{{ url('perfil/' . $user->id) }}">{{ $user->username }}</a></li>
                                <li><strong>Nom:</strong>{{ $user->name }}</li>
                                <li><strong>Cognoms:</strong>{{ $user->surname1 . ' ' .$user->surname2 }}</li>
                                <li><strong>Activació:</strong>{{ $user->state->name }}</li>
                                <li><strong>E-mail:</strong>{{ $user->email }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- TEAM MEMBER - END -->
        </div>
        <div class="box colored tournament-partner">
            <div class="row">
                @foreach ($sponsors as $p)
                    <div class="col-xs-4"><a style="width: 200px;" href=""><img src="{{ asset('images/sponsors/' . $p->logo)}}" class="img-responsive center-block" alt=""></a></div>
                @endforeach
            </div>
        </div>

        {{--<div class="box hardware">--}}
            {{--<h2>Hardware</h2>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="team-member">--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><strong>CPU</strong> </li>--}}
                            {{--<li><strong>GPU:</strong> </li>--}}
                            {{--<li><strong>RAM:</strong> </li>--}}
                            {{--<li><strong>Screen:</strong> </li>--}}
                            {{--<li><strong>Headset</strong> </li>--}}
                            {{--<li><strong>Keyboard:</strong> </li>--}}
                            {{--<li><strong>Mouse:</strong> </li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                    {{--<img src="{{ url('images/pc.jpg') }}" class="img-responsive center-block" alt="">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">
            @foreach($competicionsgroups as $c)
                @if(!empty($c->group))
                <div class="col-md-6">
                    <div class="box sidebar-box widget-wrapper">
                        <h3><a href="{{ url('competicio/' . $c->competicio->id) }}"> {{ $c->competicio->name }} </a></h3>
                        <ul class="nav nav-sidebar">
                            <li><a @if($c->competicio->number != 1) href="{{ url('group/' . $c->group->id) }}" @endif>{{ $c->group->name }}</a></li>
                        </ul>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

    </div>
    <!-- CONTENT BODY - END -->
@endsection