@extends('web.app')

@section('content')

    <script src="{{ asset('/js/inscripcio.js') }}"></script>
    <!-- ==========================
    	JUMBOTRON - START
    =========================== -->
    <div class="container">
        <div class="jumbotron">
            <div class="jumbotron-panel">
                <div class="panel panel-primary collapse-horizontal">
                    <a data-toggle="collapse" class="btn btn-primary collapsed" data-target="#toggle-collapse">@if (Auth::guest())Llista de tornejos @else Inscriure's a un torneig @endif<i class="fa fa-caret-down"></i></a>
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

                                    @foreach($competicions as $c)
                                    <tr>
                                        <td><img src="{{asset('/icons/competicions/' . $c->logo)}}" alt="competicio{{$c->id}}"></td>
                                        <td>{{$c->name}}</td>
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
                                    @foreach($competicions as $c)
                                        <tr>
                                            <td><img src="{{asset('/icons/competicions/' . $c->logo)}}" alt="competicio{{$c->id}}"></td>
                                            <td>{{$c->name}}</td>
                                            <td>
                                                @if ($c->number == 1)
                                                    <input style="margin-left:2px; margin-top:-1px;" id="{{ $c->id }}" class="ace ace-switch ace-switch-6 canvi" type="checkbox" @if($c->competicionsusersgroups != '[]') checked @endif />
                                                    <span class="lbl"></span>
                                                @else
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#inscriures{{ $c->id }}" style="margin-right: 0px; padding: 2px 10px;">Inscriure's</a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="inscriures{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="inscriures" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="color: #333;">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Inscripció a {{ $c->name }}</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                                                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                                                                            <li role="presentation" class="active"><a href="#group{{ $c->id }}" id="home-tab" role="tab" data-toggle="tab" aria-controls="group" aria-expanded="true">Crear un grup</a></li>
                                                                            @if($c->competicionsusersgroups == '[]')
                                                                                <li role="presentation" class=""><a href="#invitacion{{ $c->id }}" role="tab" id="profile-tab" data-toggle="tab" aria-controls="invitacion" aria-expanded="true">Apuntar-se a un existent</a></li>
                                                                            @endif
                                                                        </ul>
                                                                        <div id="myTabContent" class="tab-content">
                                                                            <div role="tabpanel" class="tab-pane fade active in" id="group{{ $c->id }}" aria-labelledby="home-tab">
                                                                                @if($c->competicionsusersgroups == '[]')
                                                                                    {!! Form::open(array('url' => 'competicio/afegir/' . $c->id)) !!}
                                                                                    <div class="form-group" style="max-width: 200px">
                                                                                        <label style="margin-left: 25px;" for="nom">Nom del grup</label>
                                                                                        <input style="margin-left: 50px;" type="text" class="form-control" id="nomgroup" name="nomgroup" required>
                                                                                        <input name="lloc" type="hidden" value="1">
                                                                                    </div>
                                                                                    {!! Form::submit('Apuntar-se', array( 'class' => 'btn btn-primary')) !!}
                                                                                    {!! Form::close() !!}
                                                                                @else
                                                                                    {!! Form::open(array('url' => 'competicio/borrar/' . $c->id)) !!}
                                                                                    <div class="form-group" style="max-width: 500px">
                                                                                        <label style="margin: 30px;" for="nom">Estas inscrit al grup: {{ $c->competicionsusersgroups[0]->group->name }}</label>
                                                                                    </div>
                                                                                    <input name="lloc" type="hidden" value="1">
                                                                                    {!! Form::submit('Borrar-se', array( 'class' => 'btn btn-primary')) !!}
                                                                                    {!! Form::close() !!}
                                                                                @endif
                                                                            </div>
                                                                            @if($c->competicionsusersgroups == '[]')
                                                                                <div role="tabpanel" class="tab-pane fade" id="invitacion{{ $c->id }}" aria-labelledby="profile-tab">
                                                                                    <h4>Demanar poder entrar:</h4>
                                                                                    @foreach($c->group as $g)
                                                                                        <div class="form-group" style="max-width: 500px">
                                                                                            <label style="margin: 30px;" for="nom">{{ $g->name }}</label>
                                                                                            <input style="margin-top: 32px; margin-left: -11px;" id="{{ $g->id }}" class="ace ace-switch ace-switch-6 entrar" type="checkbox" @if($equips[$g->id]['selected']) checked @endif />
                                                                                            <span style="margin: -8px;" class="lbl"></span>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tancar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

            {{--<div id="jumbotron-slider">--}}

                {{--<!-- JUMBOTRON ITEM - START -->--}}
                {{--<div class="item">--}}
                    {{--<a href="single.html">--}}
                        {{--<div class="overlay-wrapper">--}}
                            {{--<img src="{{ asset('/images/image_001.jpg')}}" class="img-responsive" alt="">--}}
                            {{--<span class="overlay"></span>--}}
                            {{--<h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<!-- JUMBOTRON ITEM - END -->--}}

                {{--<!-- JUMBOTRON ITEM - START -->--}}
                {{--<div class="item">--}}
                    {{--<a href="single.html">--}}
                        {{--<div class="overlay-wrapper">--}}
                            {{--<img src="{{ asset('/images/image_002.jpg')}}" class="img-responsive" alt="">--}}
                            {{--<span class="overlay"></span>--}}
                            {{--<h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<!-- JUMBOTRON ITEM - END -->--}}

                {{--<!-- JUMBOTRON ITEM - START -->--}}
                {{--<div class="item">--}}
                    {{--<a href="single.html">--}}
                        {{--<div class="overlay-wrapper">--}}
                            {{--<img src="{{ asset('/images/image_003.jpg')}}" class="img-responsive" alt="">--}}
                            {{--<span class="overlay"></span>--}}
                            {{--<h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<!-- JUMBOTRON ITEM - END -->--}}

                {{--<!-- JUMBOTRON ITEM - START -->--}}
                {{--<div class="item">--}}
                    {{--<a href="single.html">--}}
                        {{--<div class="overlay-wrapper">--}}
                            {{--<img src="{{ asset('/images/image_004.jpg')}}" class="img-responsive" alt="">--}}
                            {{--<span class="overlay"></span>--}}
                            {{--<h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<!-- JUMBOTRON ITEM - END -->--}}

                {{--<!-- JUMBOTRON ITEM - START -->--}}
                {{--<div class="item">--}}
                    {{--<a href="single.html">--}}
                        {{--<div class="overlay-wrapper">--}}
                            {{--<img src="{{ asset('/images/image_005.jpg')}}" class="img-responsive" alt="">--}}
                            {{--<span class="overlay"></span>--}}
                            {{--<h2>Lorem Ipsum dolor<span>27 March 2014</span></h2>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<!-- JUMBOTRON ITEM - END -->--}}

            {{--</div>--}}
        </div>
    </div>
    <!-- ==========================
    	JUMBOTRON - END
    =========================== -->

    @yield('homeContent')

@endsection
