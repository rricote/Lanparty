@extends('web.home_sidebar')

@section('homeContent')
    <div class="container">
        <section class="content-wrapper">
            <div class="row">
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
                            <a style="margin:10px; min-width: 120px;" href="http://lanparty.dev/competicions" class="btn btn-primary">Competicions</a>
                            <a style="margin:10px; min-width: 120px;" href="http://lanparty.dev/colaboradors" class="btn btn-primary">Col·laboradors</a>
                            <a style="margin:10px; min-width: 120px;" href="http://lanparty.dev/premis" class="btn btn-primary">Premis</a>
                            <a style="margin:10px; min-width: 120px;" href="http://lanparty.dev/cartell" class="btn btn-primary">Cartell</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection