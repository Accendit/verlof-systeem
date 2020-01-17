@extends('layouts.app')

@section('content')

@foreach ($absences as $absence)
    {{ $absence->id }}
    {{ $absence->startdate }}
    {{ $absence->enddate }}
    {{-- {{ if ($absence->isapproved) echo "Ja" }} --}}
    {{ $absence->submitter->name }}
@endforeach

@endsection