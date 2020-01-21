@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h2 class="display-3 text-dark m-5">Verlof aanvragen</h2>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-auto ml-auto"><a class="btn btn-lg btn-primary" href="{{ route('absences.create') }}">Nieuw verzoek</a></div>
                        </div>                        
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-responsive-xl table-striped">
                        <caption>Tabel met verlof aanvragen</caption>
                        <thead class="thead-dark">
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
                                        @isset ($absence->isapproved)
                                            <td>{{ $absence->isapproved? "Ja" : "Nee" }}</td>
                                        @else
                                            <td>Nog niet beoordeeld</td>
                                        @endisset
                                        
                                        
                                        
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                @can('approve', $absence)
                                                <form class="btn-group btn-group-sm" action="{{ route('absences.approve', $absence) }}" method="post">
                                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="material-icons">check</i>
                                                    </button>
                                                </form>
                                                @endcan
                                                @can('disapprove', $absence)
                                                <form class="btn-group btn-group-sm" action="{{ route('absences.disapprove', $absence) }}" method="post">
                                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                                @endcan
                                                @can('update', $absence)
                                                <a class="btn btn-secondary" href="{{ route('absences.edit', $absence) }}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @endcan
                                                
                                            </div>
                                        </td>
                                        
                                    </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $absences->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection