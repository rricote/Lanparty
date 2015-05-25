@extends('web.app')

@section('content')
    <!-- ==========================
        CONTENT - START
    =========================== -->
    <div class="container">
        <section class="content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box sidebar-box widget-wrapper">
                        <h3>Competicions</h3>
                        <ul class="nav nav-sidebar">
                            @foreach($competicions as $c)
                                <li><a href="{{ url('competicio/' . $c['id']) }}"><img style="max-width: 40px;" src="{{asset('/icons/competicions/' . $c['logo'])}}" alt="competicio{{ $c['id'] }}">    {{ $c['name'] }}<span>{{ $c['count'] }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ==========================
        CONTENT - END
    =========================== -->
@endsection