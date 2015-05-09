<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Usuaris;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }
        $user = Usuaris::where('usu_correu', '=', $request->input('email'))->first();

        if(isset($user)) {
            if($user->usu_pwd == md5($request->input('password'))) { // If their password is still MD5

                User::create([
                    'dni' => $user->usu_dni,
                    'name' => $user->usu_nom,
                    'cognom1' => $user->usu_cognom1,
                    'cognom2' => $user->usu_cognom2,
                    'username' => $user->usu_nick,
                    'email' => $user->usu_correu,
                    'anticuser' => $user->usu_id,
                    'estats_id' => $user->est_id,
                    'rols_id' => $user->rol_id,
                    'password' => bcrypt($request->input('password')),
                ]);
                if ($this->auth->attempt($credentials, $request->has('remember')))
                {
                    return redirect()->intended($this->redirectPath());
                }
            }
        }
        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);

    }

    public function validate(Request $request, array $rules, array $messages = array())
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

}
