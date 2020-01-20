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

        $user = Auth::user();
        $absences = [];

        foreach (Absence::All() as $absence) {
            if ($user->can('view', $absence)) {
                array_push($absences, $absence);
            }
        };

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
        $user = $request->User();

        if ($user->can('create', Absence::class)) {

            Absence::create([
                'submitter' => $user->id,
                'startdate' => $request['startdate'],
                'enddate' => $request['enddate'],
            ]);

            return redirect()->route('absences.index')->with([
                'success_alert', 'Nieuw verlof verzoek ' . Absence::latest()->first()->id . ' aangemaakt.'
            ]);

        } else {

            return redirect()->route('absences.index')->with([
                'danger_alert', 'Je bent niet gemachtigd om een verzoek in te dienen.'
            ]);

        }
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
