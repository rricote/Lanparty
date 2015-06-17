<?php namespace App\Http\Controllers;

use App\Config;
use App\Http\Controllers\Controller;
use App\Assistencia;
use App\User;
use Request;

class AssistenciesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $assistencies = Assistencia::all();
        return $assistencies;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $config = Config::find(1);

        $id = Request::input('array');

        if($usuari = User::where('ultratoken', '=', $id)->count()){

            $usuari = User::find($id);

            if($usuari->state_id == 2){

                if(!Assistencia::where('usuaris_id', '=', $id)->count()){

                    $assistencia = new Assistencia;
                    $assistencia->accio = 'ENTRADA';
                    $assistencia->user_id = $id;
                    $assistencia->edicio_id = $config->edicio_id;
                    $assistencia->save();

                    $final = 'ENTRADA';
                }else{

                    $assistencia = Assistencia::orderby('created_at', 'desc')->first();

                    if($assistencia->accio == 'ENTRADA'){
                        $assistencia = new Assistencia;
                        $assistencia->accio = 'SORTIDA';
                        $assistencia->user_id = $id;
                        $assistencia->edicio_id = $config->edicio_id;
                        $assistencia->save();
                    }else{
                        $assistencia = new Assistencia;
                        $assistencia->accio = 'ENTRADA';
                        $assistencia->user_id = $id;
                        $assistencia->edicio_id = $config->edicio_id;
                        $assistencia->save();
                    }
                    $final = $assistencia->accio;
                }

            }else
                $final = 'El compte no esta validat, passa per la taula';

        }else
            $final = 'Error al processar el token';

        return $final;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //
	}

}
