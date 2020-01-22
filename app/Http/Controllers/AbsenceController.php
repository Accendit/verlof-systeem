<?php

namespace App\Http\Controllers;

use App\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAbsenceMail;
use App\Mail\ChangedAbsenceMail;
use App\User;
use Adldap\Laravel\Facades\Adldap;

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
        $user = $request->User();

        if (!$user->can('create', Absence::class)) {
            return redirect()->route('absences.index')->with([
                'danger_alert' => 'Je bent niet gemachtigd om een verzoek in te dienen.'
            ]);
        }

        $absence = Absence::create([
            'submitter' => $user->id,
            'startdate' => $request['startdate'],
            'enddate' => $request['enddate'],
        ]);

        
        $ldap = Adldap::getFacadeRoot();
        $members = $ldap->search()->where('samaccountname', '=', env('LDAP_MANAGEMENT_GROUP'))->first()->member;

        foreach ($members as $member) {
            $mail = $ldap->search()->findByDn($member)->mail;
            Mail::to($mail)
                ->send(new NewAbsenceMail($absence));
        }
        

        return redirect()->route('absences.index')->with([
            'success_alert' => 'Nieuw verlof verzoek ' . $absence->id . ' aangemaakt.'
        ]);

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
        $user = $request->User();

        if (!$user->can('update', $absence)) {
            return redirect()->route('absences.index')->with([
                'danger_alert' => 'U kan verzoek ' . $absence->id . ' niet (meer) wijzigen.'
            ]);
        }
            

        $absence->startdate = $request['startdate'];
        $absence->enddate = $request['enddate'];
        $absence->save();

        return redirect()->route('absences.index')->with([
            'succes_alert' => 'Verlof verzoek ' . $absence->id . ' succesvol gewijzigd.'
        ]);

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

        if (!$user->can('approve', $absence)) {
            return back()->with([
                'danger_alert' => 'U bent niet gemachtigd. '
            ]);
        }

        $absence->approve();
        $submitter = User::findOrFail($absence->submitter);

        Mail::to($submitter->mail)
            ->send(new ChangedAbsenceMail($absence));

        return back()->with([
            'success_alert' => 'Verzoek ' . $absence->id . ' goedgekeurd.'
        ]);

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

        if (!$user->can('disapprove', $absence)) {

            return back()->with([
                'danger_alert' => 'U bent niet gemachtigd. '
            ]);

        }

        $absence->disapprove();
        $submitter = User::findOrFail($absence->submitter);

        Mail::to($submitter->mail)
            ->send(new ChangedAbsenceMail($absence));
        
        return back()->with([
            'success_alert' => 'Verzoek ' . $absence->id . ' afgekeurd.'
        ]);

    }
}
