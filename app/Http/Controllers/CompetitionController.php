<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Competition;
use Illuminate\Support\Facades\File;
use Request;

class CompetitionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $competitions = Competition::all();
        return $competitions;
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
        $competition = Competition::find($id);

        File::delete('icons/competitions/' . $competition->logo);
        File::delete('images/competitions/' . $competition->imatge);

        Competition::destroy($id);

        return "CORRECTE";
    }

}
