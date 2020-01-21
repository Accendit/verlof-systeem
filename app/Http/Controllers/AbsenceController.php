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
        $absences = Absence::all();

        $filtered = $absences->filter(function ($item) {
            return Auth::User()->can('view', $item);
        });

        return view('absence.index', ['absences' => $filtered]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('absence.single');

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

            $absence = Absence::create([
                'submitter' => $user->id,
                'startdate' => $request['startdate'],
                'enddate' => $request['enddate'],
            ]);

            return redirect()->route('absences.index')->with([
                'success_alert' => 'Nieuw verlof verzoek ' . $absence->id . ' aangemaakt.'
            ]);

        } else {

            return redirect()->route('absences.index')->with([
                'danger_alert' => 'Je bent niet gemachtigd om een verzoek in te dienen.'
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
        return view('absence.single', ['absence' => $absence]);
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
        $user = $request->User();

        if ($user->can('update', $absence)) {
            $absence->startdate = $request['startdate'];
            $absence->enddate = $request['enddate'];
            $absence->save();
            return redirect()->route('absences.index')->with([
                'succes_alert' => 'Verlof verzoek ' . $absence->id . ' succesvol gewijzigd.'
            ]);;
        }
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
     * Approve an Absence request.
     *
     * @param \App\Absence  $absence
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Absence $absence, Request $request)
    {
        $user = $request->User();

        if ($user->can('approve', $absence)) {

            $absence->approve();
            return back()->with([
                'success_alert' => 'Verzoek ' . $absence->id . ' goedgekeurd.'
            ]);

        } else {

            return back()->with([
                'danger_alert' => 'U bent niet gemachtigd. '
            ]);
            
        };
    }

    /**
     * Disapprove an Absence request.
     * 
     * @param Absence $absence
     * @param Request $request
     * 
     * @return void
     */
    public function disapprove(Absence $absence, Request $request)
    {
        $user = $request->User();


        if ($user->can('disapprove', $absence)) {

            $absence->disapprove();
            return back()->with([
                'success_alert' => 'Verzoek ' . $absence->id . ' afgekeurd.'
            ]);

        } else {

            return back()->with([
                'danger_alert' => 'U bent niet gemachtigd. '
            ]);

        }
    }
}
