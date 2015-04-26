<?php namespace App\Http\Controllers;

use App\Assistencies;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        //buscar l'usuari Request::input('id')
        $usuari = new User();
        $usuari::where('usu_id', '=', Request::input('id'))->get();


        return $usuari;
        $assistencies = Assistencies();
        /*if($assistencies->accio )
        $accio
        $assistencies = Assistencies;//::create(Request::all());
        $assistencies->accio =
        $assistencies->save();
        return $assistencies;*/
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
        $assistencies = Assistencies::find($id);
        $assistencies->accio = Request::input('accio');
        $assistencies->save();

        return $assistencies;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Assistencies::destroy($id);
	}

}
