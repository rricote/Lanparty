@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <h2>Registre</h2>
                        </div>
                    </div>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">DNI</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="usu_dni" value="{{ old('usu_dni') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nom</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="usu_nom" value="{{ old('usu_nom') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Primer cognom</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="usu_cognom1" value="{{ old('usu_cognom1') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Segon cognom</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="usu_cognom2" value="{{ old('usu_cognom2') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nick</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="usu_nick" value="{{ old('usu_nick') }}">
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="usu_correu" value="{{ old('usu_correu') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contrasenya</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="usu_pwd">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmació de la contrasenya</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="usu_pwd_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
