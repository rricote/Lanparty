<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
            'usu_dni' => 'max:10',
            'usu_nom' => 'required|max:30',
            'usu_cognom1' => 'required|max:30',
            'usu_cognom2' => 'required|max:30',
            'usu_nick' => 'required|max:30',
			'usu_correu' => 'required|email|max:40|unique:usuaris',
            'usu_pwd' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'usu_dni' => $data['usu_dni'],
            'usu_nom' => $data['usu_nom'],
            'usu_cognom1' => $data['usu_cognom1'],
            'usu_cognom2' => $data['usu_cognom2'],
            'usu_nick' => $data['usu_nick'],
            'usu_correu' => $data['usu_correu'],
			'usu_pwd' => md5($data['usu_pwd']),
		]);
	}

}
