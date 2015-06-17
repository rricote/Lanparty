@extends('web.sidebar')

@section('side')
<!-- CONTENT BODY - START -->
<div class="col-xs-12 col-sm-8">

    <div class="box colored tournament-partner">
        <div class="row">
            @foreach ($sponsorsgold as $p)
                <div class="col-xs-4"><a style="width: 200px;" href="{{ $p->link }}"><img src="{{ asset('images/sponsors/' . $p->logo)}}" class="img-responsive center-block" alt=""/></a></div>
            @endforeach
        </div>
    </div>

    <div class="box col-xs-12">
        <h2 style="font-size: 24px;" class="gold-l">Sponsors Gold</h2>
        @foreach ($sponsorsgold as $p)
            @if($p->premi != '[]')
                <!-- POST - START -->
                <article class="col-xs-12 post">
                    <div class="col-xs-12 col-sm-4 post-date-wrapper">
                        <div class="post-date premis-gold">
                            <img src="{{ asset('images/sponsors/' . $p->logo)}}" class="img-responsive center-block" alt=""/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 post-body">
                        <h2>{{ $p->name }}</h2>
                        @foreach ($p->premi as $premi)
                            <hr>
                            <p>{{ $premi->name }}</p>
                        @endforeach
                    </div>
                </article>
                <!-- POST - END -->
            @endif
        @endforeach

        <h2 style="font-size: 24px;" class="silver-l">Patrocinadors Silver</h2>
        @foreach ($sponsorssilver as $p)
            @if($p->premi != '[]')
                <!-- POST - START -->
                <article class="col-xs-12 post">
                    <div class="col-xs-12 col-sm-4 post-date-wrapper">
                        <div class="post-date premis-silver">
                            <img src="{{ asset('images/sponsors/' . $p->logo)}}" class="img-responsive center-block" alt=""/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 post-body">
                        <h2>{{ $p->name }}</h2>
                        @foreach ($p->premi as $premi)
                            <hr>
                            <p>{{ $premi->name }}</p>
                        @endforeach
                    </div>
                </article>
                <!-- POST - END -->
            @endif
        @endforeach
        <h2 style="font-size: 24px;" class="bronze-l">Patrocinadors Bronze</h2>
        @foreach ($sponsorsbronze as $p)
            <!-- POST - START -->
            <article class="col-xs-12 post">
                <div class="col-xs-12 col-sm-4 post-date-wrapper">
                    <div class="post-date premis-bronze">
                        <img src="{{ asset('images/sponsors/' . $p->logo)}}" class="img-responsive center-block" alt=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 post-body">
                    <h2>{{ $p->name }}</h2>
                    @foreach ($p->premi as $premi)
                        <hr>
                        <p>{{ $premi->name }}</p>
                    @endforeach
                </div>
            </article>
            <!-- POST - END -->
        @endforeach
    </div>

</div>
<!-- CONTENT BODY - END -->
@endsection