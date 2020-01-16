<?php

namespace App\Http\Controllers;

use App\Verlof;
use Illuminate\Http\Request;

class VerlofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('verlof', ['verlofs' => Verlof::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($startdatum, $einddatum, $aanvragerid)
    {
        //
        $verlof = new Verlof;
        $verlof->startdatum = startdatum;
        $verlof->einddatum = einddatum;
        $verlof->isgoedgekeurd = false;
        $verlof->aanvrager = $aanvragerid;
        $verlof->save();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function show(Verlof $verlof)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function edit(Verlof $verlof)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verlof $verlof)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verlof $verlof)
    {
        //
    }

    public function approve(Verlof $verlof)
    {
        $verlof->isgoedgekeurd = true;
        $verlof->save();
    }
}
