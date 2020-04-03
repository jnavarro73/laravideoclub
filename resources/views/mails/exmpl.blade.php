@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Tienes una nueva peli o serie sin ver :
{{ $titulo ?? '' }}


Click abajo para verla:
@component('mail::button', ['url' => $link])

@endcomponent
Sincerely,  
{{config('app.name')}} team.
@endcomponent
