<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Assistencies;
use App\Usuaris;
use Request;

class AssistenciesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $assistencies = Assistencies::all();
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
        $array = Request::input('array');
        /*$array = explode(":", $array);
        $id = $array[1];
        if(is_int($id))
            return true;
        else
            return false;
*/
        $id = Request::input('array');
        $usuari = Usuaris::find($id);

        if($usuari->est_id != 2){
            return false;
        }
        function isInteger($input){
            return(ctype_digit(strval($input)));
        }
        if(!Assistencies::where('usuaris_id', '=', $id)->count()){
            $assistencies = new Assistencies;
            $assistencies->accio = 'ENTRADA';
            $assistencies->usuaris_id = $id;
            $assistencies->save();
        }else{
            $assistencies = Assistencies::orderby('created_at', 'desc')->first();
            if($assistencies->accio == 'ENTRADA'){
                $assistencies = new Assistencies;
                $assistencies->accio = 'SORTIDA';
                $assistencies->usuaris_id = $id;
                $assistencies->save();
            }else{
                $assistencies = new Assistencies;
                $assistencies->accio = 'ENTRADA';
                $assistencies->usuaris_id = $id;
                $assistencies->save();
            }
        }
        return $assistencies->accio;
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
