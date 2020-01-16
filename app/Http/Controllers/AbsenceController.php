<?php

namespace App\Http\Controllers;

use App\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('absence', ['absences' => Absence::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($startdatum, $einddatum, $aanvragerid)
    {
        //
        $absence = new Absence;
        $absence->startdatum = startdatum;
        $absence->einddatum = einddatum;
        $absence->isgoedgekeurd = false;
        $absence->aanvrager = $aanvragerid;
        $absence->save();

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
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }

    public function approve(Absence $absence)
    {
        $absence->isgoedgekeurd = true;
        $absence->save();
    }
}
