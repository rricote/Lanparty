<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuaris;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $usuaris = Usuaris::all();
        //$usuaris = User::all();
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
        $user = Usuaris::create([
            'usu_dni' => Request::input('dni'),
            'usu_nom' => Request::input('nom'),
            'usu_cognom1' => Request::input('cognom1'),
            'usu_cognom2' => Request::input('cognom2'),
            'usu_nick' => Request::input('username'),
            'usu_correu' => Request::input('email'),
            'usu_pwd' => md5(Request::input('password')),
            'token' => $token,
            'est_id' => 1,
            'rol_id' => 2,
        ]);

        return User::create([
            'dni' => Request::input('dni'),
            'name' => Request::input('nom'),
            'cognom1' => Request::input('cognom1'),
            'cognom2' => Request::input('cognom2'),
            'username' => Request::input('username'),
            'email' => Request::input('email'),
            'ultratoken' => $token,
            'anticuser' => $user->usu_id,
            'password' => bcrypt(Request::input('password')),
            'estats_id' => 1,
            'rols_id' => 2,
        ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return Usuaris::find($id);
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
        $user = Usuaris::find($id);
        $user->usu_dni = Request::input('dni');
        $user->usu_nom = Request::input('name');
        $user->usu_cognom1 = Request::input('cognom1');
        $user->usu_cognom2 = Request::input('cognom2');
        $user->usu_nick = Request::input('username');
        $user->usu_correu = Request::input('email');
        $user->usu_pwd = md5(Request::input('password'));
        $user->est_id = 1;
        $user->rol_id = 2;
        $user->save();

        $usuaris = User::where('anticuser', '=', $id)->first();
        $usuaris->dni = Request::input('dni');
        $usuaris->name = Request::input('name');
        $usuaris->cognom1 = Request::input('cognom1');
        $usuaris->cognom2 = Request::input('cognom2');
        $usuaris->username = Request::input('username');
        $usuaris->email = Request::input('email');
        $usuaris->password = bcrypt(Request::input('password'));
        $usuaris->estats_id = 1;
        $usuaris->rols_id = 2;
        $usuaris->save();

        return $user;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Usuaris:destroy($id);
        User::where('anticuser', '=', $id)->delete();
	}

}
