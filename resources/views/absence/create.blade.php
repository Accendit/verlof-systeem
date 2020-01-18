@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg8">
            <div class="card">
                <div class="card-header">
                    <h3>Nieuwe verlof aanvraag indienen</h3>
                </div>
                <div class="card-body">

                    <form action="/absences" method="post">
                        <div class="form-group">
                            <label for="startdate">Start Datum:</label>
                            <input type="text" class="form-control" id="startdate" placeholder="Start datum">
                        </div>
                        <div class="form-group">
                            <label for="enddate">Eind Datum:</label>
                            <input type="text" class="form-control" id="enddate" placeholder="Eind datum">
                        </div>
                        <button type="submit" class="btn btn-primary">Indienen</button>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
</div>


@endsection