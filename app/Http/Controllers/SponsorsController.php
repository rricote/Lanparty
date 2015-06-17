<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Support\Facades\File;
use Request;

class SponsorsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        return $sponsors;
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
        $sponsor = Sponsor::find($id);

        File::delete('images/sponsors/' . $sponsor->logo);

        Sponsor::destroy($id);

        return "CORRECTE";
    }

}
