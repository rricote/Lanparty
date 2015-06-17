<?php namespace App\Http\Controllers;

use App\Config;
use App\Http\Controllers\Controller;
use App\Assistance;
use App\User;
use Request;

class AssistancesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $assistances = Assistance::all();
        return $assistances;
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

                if(!Assistance::where('usuaris_id', '=', $id)->count()){

                    $assistance = new Assistance;
                    $assistance->accio = 'ENTRADA';
                    $assistance->user_id = $id;
                    $assistance->edition_id = $config->edition_id;
                    $assistance->save();

                    $final = 'ENTRADA';
                }else{

                    $assistance = Assistance::orderby('created_at', 'desc')->first();

                    if($assistance->accio == 'ENTRADA'){
                        $assistance = new Assistance;
                        $assistance->accio = 'SORTIDA';
                        $assistance->user_id = $id;
                        $assistance->edition_id = $config->edition_id;
                        $assistance->save();
                    }else{
                        $assistance = new Assistance;
                        $assistance->accio = 'ENTRADA';
                        $assistance->user_id = $id;
                        $assistance->edition_id = $config->edition_id;
                        $assistance->save();
                    }
                    $final = $assistance->accio;
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
