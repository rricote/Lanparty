<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Assistencia;
use Request;

class ValidacioController extends Controller {

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id)
	{
        try {
            $usuaris = User::find($id);
            $usuaris->estat_id = Request::input('estat');
            $usuaris->save();
        } catch (Exception $e) {
            return 'no';
        }
        if(Request::input('estat') == 2){
            if(!Assistencia::where('user_id', '=', $id)->count()){
                $assistencies = new Assistencia;
                $assistencies->accio = 'ENTRADA';
                $assistencies->user_id = $id;
                $assistencies->save();
            }else{
                $assistencies = Assistencia::orderby('created_at', 'desc')->first();
                if($assistencies->accio == 'SORTIDA'){
                    $assistencies = new Assistencia;
                    $assistencies->accio = 'ENTRADA';
                    $assistencies->user_id = $id;
                    $assistencies->save();
                }
            }
        } else {
            if(Assistencia::where('user_id', '=', $id)->count()){
                $assistencies = Assistencia::orderby('created_at', 'desc')->first();
                if($assistencies->accio == 'ENTRADA'){
                    $assistencies = new Assistencia;
                    $assistencies->accio = 'SORTIDA';
                    $assistencies->user_id = $id;
                    $assistencies->save();
                }
            }
        }
        return 'guay';
	}

}
