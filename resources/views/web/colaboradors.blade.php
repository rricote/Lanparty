@extends('web.sidebar')

@section('side')
    <!-- CONTENT BODY - START -->
    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="row">
                <h2 style="padding: 0 15px;">Col·laboradors GOLD</h2>
            </div>
        </div>
        <div class="box colored tournament-partner gold">
            <div class="row">
                @foreach ($patrocinadorsgold as $p)
                    <div class="col-xs-6"><a style="width: 200px;" href=""><img src="{{ asset('images/patrocinadors/' . $p->logo)}}" class="img-responsive center-block" alt=""></a></div>
                @endforeach
            </div>
        </div>
        <div class="box">
            <div class="row">
                <h2 style="padding: 0 15px;">Col·laboradors SILVER</h2>
            </div>
        </div>
        <div class="box colored tournament-partner silver">
            <div class="row">
                @foreach ($patrocinadorssilver as $p)
                    <div class="col-xs-6"><a href=""><img style="width: 200px;" src="{{ asset('images/patrocinadors/' . $p->logo)}}" class="img-responsive center-block" alt=""></a></div>
                @endforeach
            </div>
        </div>
        <div class="box">
            <div class="row">
                <h2 style="padding: 0 15px;">Col·laboradors BRONZE</h2>
            </div>
        </div>
        <div class="box colored tournament-partner bronze">
            <div class="row">
                @foreach ($patrocinadorsbronze as $p)
                    <div class="col-xs-6"><a href=""><img style="width: 200px;" src="{{ asset('images/patrocinadors/' . $p->logo)}}" class="img-responsive center-block" alt=""></a></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- CONTENT BODY - END -->
@endsection