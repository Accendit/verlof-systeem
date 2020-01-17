@extends('layouts.app')

@section('content')

@foreach ($absences as $absence)
    {{ $absence->id }}
    {{ $absence->startdate }}
    {{ $absence->enddate }}
    {{ $absence->isapproved? "Ja" : "Nee" }}
    {{ $absence->submitter()->name }}
    @if (Auth::User()->isManager())
        {{ "Hier komt mooie goedkeur knop" }}
    @endif
@endforeach

@endsection