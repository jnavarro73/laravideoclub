@extends('layouts.master')
@section('content')
{{-- dd($oPelicula) --}}
<h2>{{$oPelicula['title']}}</h2>
<div class="col-md-12 ">
<b>Director: </b>{{$oPelicula['director']}} 

</div>
<div class="col-md-12">
	<b>Categoria: </b>{{$oPelicula->categoria}}
</div>
<div class="col-md-8 ">
<b>Sinopsis: </b>{{$oPelicula['synopsis']}}
</div>
<div class=" col-md-12 ">
<b>Año: </b>{{$oPelicula['year']}}
</div>
@stop