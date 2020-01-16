@extends('layouts.app')

@section('content')

@foreach ($verlofs as $verlof)
    {{ $verlof->id }}
    {{ $verlof->startdatum }}
    {{ $verlof->einddatum }}
    {{ $verlof->isgoedgekeurd }}
@endforeach

@endsection