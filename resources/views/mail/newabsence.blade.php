@component('mail::message')
# Er is een nieuwe aanvraag ingedient!

De aanvraag is ingedient op {{ date_format($absence->created_at, 'd-m-Y') }} door {{ $submitter_name }}.
Om de aanvraag te beoordelen klikt u op onderstaande knop.

@component('mail::button', ['url' => route('absences.index')])
Bekijk nu
@endcomponent

Met vriendelijken groeten,<br>
{{ config('app.name') }}
@endcomponent
