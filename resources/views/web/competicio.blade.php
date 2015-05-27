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
                    @if(!Auth::guest())
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
                                                <li role="presentation" class=""><a href="#invitacion" role="tab" id="profile-tab" data-toggle="tab" aria-controls="invitacion" aria-expanded="true">Apuntar-se a un existent</a></li>
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="grup" aria-labelledby="home-tab">
                                                    {!! Form::open(array('url' => 'competicio/multiple/afegir/' . $competicio->id)) !!}
                                                        <div class="form-group" style="max-width: 200px">
                                                            <label style="margin-left: 25px;" for="nom">Nom del grup</label>
                                                            <input style="margin-left: 50px;" type="text" class="form-control" id="nomgrup" name="nomgrup">
                                                        </div>
                                                        {!! Form::submit('Apuntar-se', array( 'class' => 'btn btn-primary')) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="invitacion" aria-labelledby="profile-tab">

                                                </div>
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
                    <a target="_blank" href="{{ $competicio->link }}" class="btn btn-inverse btn-lg">Lloc oficial</a>
                </div>

                <div class="col-xs-3">
                    <img style="width: 300px;" src="{{ url('images/competicions/' . $competicio->imatge) }}" class="img-responsive center-block" alt="Competicio{{ $competicio->id }}">
                </div>
            </div>
            <p class="countdown-info">El torneig comença en:</p>
            <div class="countdown countdowntorneig"></div>
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

                    <!-- GROUP - START -->
                    <div class="col-sm-6">
                        <h3>Group A</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>M</th>
                                    <th>W</th>
                                    <th>L</th>
                                    <th>RD</th>
                                    <th>P</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- GROUP - END -->

                    <!-- GROUP - START -->
                    <div class="col-sm-6">
                        <h3>Group B</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>M</th>
                                    <th>W</th>
                                    <th>L</th>
                                    <th>RD</th>
                                    <th>P</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- GROUP - END -->

                    <!-- GROUP - START -->
                    <div class="col-sm-6">
                        <h3>Group C</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>M</th>
                                    <th>W</th>
                                    <th>L</th>
                                    <th>RD</th>
                                    <th>P</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- GROUP - END -->

                    <!-- GROUP - START -->
                    <div class="col-sm-6">
                        <h3>Group D</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>M</th>
                                    <th>W</th>
                                    <th>L</th>
                                    <th>RD</th>
                                    <th>P</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><img src="assets/icons/swe.png" alt=""> NiP</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0/0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- GROUP - END -->
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