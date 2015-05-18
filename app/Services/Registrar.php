<?php namespace App\Services;

use App\User;
use App\Usuaris;
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
            'dni' => 'max:10',
            'nom' => 'required|max:30',
            'cognom1' => 'required|max:30',
            'cognom2' => 'required|max:30',
            'username' => 'required|max:30',
			'email' => 'required|email|max:40|unique:users',
            'password' => 'required|confirmed|min:6',
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
			'dni' => $data['dni'],
            'name' => $data['nom'],
            'cognom1' => $data['cognom1'],
            'cognom2' => $data['cognom2'],
            'username' => $data['username'],
            'email' => $data['email'],
            'ultratoken' => md5(uniqid(rand(), true)),
			'password' => bcrypt($data['password']),
            'estats_id' => 1,
            'rols_id' => 2,
		]);
	}

}