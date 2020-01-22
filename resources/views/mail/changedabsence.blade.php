@component('mail::message')
# Uw verzoek is {{ $absence->isapproved? 'goedgekeurd!' : 'afgekeurd!' }}

U kunt uw bestaande verzoek(en) bekijken of een nieuw verzoek indienen met onderstaande knop.

@component('mail::button', ['url' => route('absences.index')])
Bekijk uw verzoeken
@endcomponent

Met vriendelijke groeten,<br>
{{ config('app.name') }}
@endcomponent
