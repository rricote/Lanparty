@extends('web.app')

@section('content')
<!-- ==========================
    CONTENT - START
=========================== -->
<div class="container">
    <section class="content-wrapper">
        <!-- MATCH DETAIL - START -->
        <div class="box tournament-detail">
            <div class="row">

                <div class="col-xs-9">
                    <h2>{{ $competicio->name }}</h2>
                    <p class="date">March 12-15, 2015. Tortosa, Ebreland.</p>
                    @if(!Auth::guest() && $competicio->estat != 1)
                        @if($competicio->data_inici > date('Y-m-d H:i:s'))
                            @if($competicio->number > 1)
                            <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#inscriures" style="margin-right: 5px;">Inscriure's</a>
                            <!-- Modal -->
                            <div class="modal fade" id="inscriures" tabindex="-1" role="dialog" aria-labelledby="inscriures" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Inscripció a {{ $competicio->name }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                                <ul id="myTab" class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#grup" id="home-tab" role="tab" data-toggle="tab" aria-controls="grup" aria-expanded="true">Crear un grup</a></li>
                                                    @if(empty($competicionsgrups))
                                                        <li role="presentation" class=""><a href="#invitacion" role="tab" id="profile-tab" data-toggle="tab" aria-controls="invitacion" aria-expanded="true">Apuntar-se a un existent</a></li>
                                                    @endif
                                                </ul>
                                                <div id="myTabContent" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="grup" aria-labelledby="home-tab">
                                                        @if(empty($competicionsgrups))
                                                            {!! Form::open(array('url' => 'competicio/afegir/' . $competicio->id)) !!}
                                                                <div class="form-group" style="max-width: 200px">
                                                                    <label style="margin-left: 25px;" for="nom">Nom del grup</label>
                                                                    <input style="margin-left: 50px;" type="text" class="form-control" id="nomgrup" name="nomgrup" required>
                                                                </div>
                                                                {!! Form::submit('Apuntar-se', array( 'class' => 'btn btn-primary')) !!}
                                                            {!! Form::close() !!}
                                                        @else
                                                            {!! Form::open(array('url' => 'competicio/borrar/' . $competicio->id)) !!}
                                                            <div class="form-group" style="max-width: 500px">
                                                                <label style="margin: 30px;" for="nom">Estas inscrit al grup: {{ $competicionsgrups->grup->name }}</label>
                                                            </div>
                                                            {!! Form::submit('Borrar-se', array( 'class' => 'btn btn-primary')) !!}
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </div>
                                                    @if(empty($competicionsgrups))
                                                        <div role="tabpanel" class="tab-pane fade" id="invitacion" aria-labelledby="profile-tab">
                                                            <h4>Demanar poder entrar:</h4>
                                                            @foreach($equips as $key => $value)
                                                                <div class="form-group" style="max-width: 500px">
                                                                    <label style="margin: 30px;" for="nom">{{ $value }}</label>
                                                                    <input id="{{ $key }}" class="ace ace-switch ace-switch-6 entrar" type="checkbox" @if(!empty($competicionsgrups)) checked @endif />
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
                            @else
                                <a style="padding: 1px 15px;" class="btn btn-inverse btn-lg">
                                    <p style="margin: 0;">Inscripció</p>
                                    <input id="{{ $competicio->id }}" class="ace ace-switch ace-switch-6 canvi" type="checkbox" @if(!empty($competicionsgrups)) checked @endif />
                                    <span class="lbl"></span>
                                </a>
                            @endif
                        @endif
                    @endif
                    <a target="_blank" href="{{ $competicio->link }}" class="btn btn-inverse btn-lg">Lloc oficial</a>
                </div>

                <div class="col-xs-3">
                    <img style="width: 300px;" src="{{ url('images/competicions/' . $competicio->imatge) }}" class="img-responsive center-block" alt="Competicio{{ $competicio->id }}">
                </div>
            </div>
            @if($competicio->data_inici > date('Y-m-d H:i:s'))
                <p class="countdown-info">El torneig comença en:</p>
                <div class="countdown countdowntorneig"></div>
            @else
                @if($competicio->estat)
                    <hr>
                    <h2 style="text-align: center;">Torneig finalitzat</h2>
                @else
                    <hr>
                    <h2 style="text-align: center;">Torneig disputant-se</h2>
                @endif
            @endif
        </div>
        <!-- MATCH DETAIL - END -->

        <div class="box colored tournament-partner">
            <div class="row">
                @foreach ($patrocinadors as $p)
                    <div class="col-xs-4"><a style="width: 200px;" href=""><img src="{{ asset('images/patrocinadors/' . $p->logo)}}" class="img-responsive center-block" alt=""></a></div>
                @endforeach
            </div>
        </div>

        <div class="box">
            <!-- TOURNAMENT GROUPS - START -->
            <div class="tournament-groups">
                <div class="row">
                    @if($competicio->number > 1)
                        @foreach($competicio->grup as $c)
                        <!-- GROUP - START -->
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                            <h3>{{ $c->name }}</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Integrants</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($c->competicionsusersgrups as $competi)
                                        <tr>
                                            <td>{{ $competi->user->username }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- GROUP - END -->
                        @endforeach
                    @else
                        <div class="col-sm-offset-3 col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h3>Jugadors del Torneig</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($competicio->grup as $c)
                                        <tr>
                                            <td>{{ $c->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- TOURNAMENT GROUPS - END -->
        </div>
    </section>
</div>
<!-- ==========================
    CONTENT - END
=========================== -->
<script>
    var countdowntimetorneig = '{{ str_replace("-", "/", $competicio->data_inici) }}';
</script>
@endsection