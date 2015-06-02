@extends('web.app')

@section('content')
    <div class="container">
        <section class="content-wrapper">
            <div class="box">

                <!-- ERROR - START -->
                <div class="error">
                    <h2>Error 404 - Page not found</h2>

                    <a href="{{ url() }}" class="btn btn-primary btn-lg">Tornar a la pagina principal</a>
                </div>
                <!-- ERROR - END -->

            </div>
        </section>
    </div>
@endsection