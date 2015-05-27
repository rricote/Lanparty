<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Competicio;
use Illuminate\Support\Facades\File;
use Request;

class CompeticionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $competicions = Competicio::all();
        return $competicions;
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
        //
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
        $competicio = Competicio::find($id);

        File::delete('icons/competicions/' . $competicio->logo);
        File::delete('images/competicions/' . $competicio->imatge);

        Competicio::destroy($id);

        return "CORRECTE";
    }

}