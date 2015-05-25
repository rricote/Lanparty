@extends('web.sidebar')

@section('side')
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
    <div class="box sidebar-box widget-wrapper">
        <div>
            <img style="width: 100%; height: 100%" src="{{ url('images/cartell/' . $cartell) }}" />
        </div>
    </div>
</div>
@endsection