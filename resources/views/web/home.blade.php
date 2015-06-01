@extends('web.home_sidebar')

@section('homeContent')
    <div class="container">
        <section class="content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box sidebar-box widget-wrapper">
                        <h3>Competicions</h3>
                        <ul class="nav nav-sidebar">
                            @foreach($competicions as $c)
                                @if($c->grup != '[]')
                                {{ $c->grup[0]->name }}
                                @endif
                                <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection