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
                        <div>
                            <img style="width: 100%; height: 100%" src="{{ url('images/cartell/' . $cartell) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ==========================
        CONTENT - END
    =========================== -->
@endsection