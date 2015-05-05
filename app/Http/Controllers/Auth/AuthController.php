<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'usu_correu' => 'required|email', 'usu_pwd' => 'required',
        ]);

        //$credentials = $request->only('usu_correu', 'usu_pwd');
        $usu_correu = $request->input('usu_correu');
        $usu_pwd = $request->input('usu_pwd');
        $credentials = array('usu_correu' => $usu_correu, 'usu_pwd' => md5($usu_pwd));
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('usu_correu', 'remember'))
            ->withErrors([
                'usu_correu' => $this->getFailedLoginMessage(),
            ]);
    }

    public function validate(Request $request, array $rules, array $messages = array())
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

}
