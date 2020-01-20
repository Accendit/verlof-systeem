<?php

namespace App\Http\Controllers;

use App\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::User()->isManager())
        {
            $absences = Absence::paginate(15);
        }
        else
        {
            $absences = Absence::Where('submitter', Auth::User()->id)->paginate(15);
        }

        return view('absence.index', ['absences' => $absences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('absence.create');

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
        $startdate = $request['startdate'];
        $enddate = $request['enddate'];
        $userid = Auth::User()->id;
        $absence = new Absence();
        $absence->submitter = $userid;
        $absence->startdate = $startdate;
        $absence->enddate = $enddate;
        $absence->isapproved = false;
        $absence->save();
        return redirect()->route("absences.index")->with(
            'success_alert', 'Nieuw verlof verzoek ' . $absence->id . ' aangemaakt.'
        );
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


    /**
     * Approve an Absence request
     *
     * @param \App\Absence  $absence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Absence $absence)
    {
        if (!Auth::user()->isManager())
        {
            return back()->with([
                'danger_alert' => 'Je bent niet ingelogd als manager!.'
            ]);
        }

        $absence->approve();

        return back()->with(
            'success_alert', 'Verzoek ' . $absence->id . ' goedgekeurd.'
        );
    }
}
