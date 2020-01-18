@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h3>Verlof aanvragen</h3>
                        <a class="btn btn-sm btn-primary" href="/absences/create">Nieuw verzoek</a>
                    </div>
                    
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-xl">
                        <caption>Tabel met verlof aanvragen</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Aanvrager</th>
                                <th scope="col">Start datum</th>
                                <th scope="col">Eind datum</th>
                                <th scope="col">Goedgekeurd</th>
                                <th scope="col">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absences as $absence)
                            <tr>
                                <th>{{ $absence->id }}</th>
                                <td>{{ $absence->submitter()->name }}</td>
                                <td>{{ $absence->startdate }}</td>
                                <td>{{ $absence->enddate }} </td>
                                <td>{{ $absence->isapproved? "Ja" : "Nee" }}</td>
                                
                                
                                <td>
                                    <div class="btn-group" role="group">
                                        @if (Auth::User()->isManager() && !$absence->isapproved)
                                        <button class="btn btn-primary" type="submit">Goedgekeuren</button>
                                    @endif
                                    @if (Auth::User()->id === $absence->submitter()->id)
                                        <button class="btn btn-secondary">Bewerk</button>
                                    @endif
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $absences->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection