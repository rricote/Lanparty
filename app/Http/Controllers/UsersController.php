<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $usuaris = User::all();
        return $usuaris;
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
        $token = md5(uniqid(rand(), true));

        User::create([
            'dni' => Request::input('dni'),
            'name' => Request::input('nom'),
            'surname1' => Request::input('surname1'),
            'surname2' => Request::input('surname2'),
            'username' => Request::input('username'),
            'email' => Request::input('email'),
            'ultratoken' => $token,
            'password' => bcrypt(Request::input('password')),
            'state_id' => 1,
            'rol_id' => 2,
        ]);

        return 'CORRECTE';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return User::find($id);
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

        $usuaris = User::find($id);
        $usuaris->dni = Request::input('dni');
        $usuaris->name = Request::input('name');
        $usuaris->surname1 = Request::input('surname1');
        $usuaris->surname2 = Request::input('surname2');
        $usuaris->username = Request::input('username');
        $usuaris->email = Request::input('email');
        $usuaris->password = bcrypt(Request::input('password'));
        $usuaris->state_id = 1;
        $usuaris->rol_id = 2;
        $usuaris->save();

        return $usuaris;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        User::destroy($id);
	}

}
