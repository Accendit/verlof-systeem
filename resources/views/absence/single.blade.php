                    @isset($absence)
                        <h3>Bewerken verlof aanvraag {{ $absence->id }}</h3>
                <form action="{{ isset($absence)? route('absences.update', $absence): route('absences.store') }}" method="post">
                        <input name="startdate" type="text" class="form-control" id="startdate" placeholder="Start datum" value="{{ isset($absence)? $absence->startdate : '' }}">
                        <input name="enddate" type="text" class="form-control" id="enddate" placeholder="Eind datum" value="{{ isset($absence)? $absence->enddate: '' }}">
                        @isset($absence)
                            <input type="hidden" name="_method" value="put">
