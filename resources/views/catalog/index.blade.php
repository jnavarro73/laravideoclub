@extends('layouts.master')
@section('content')
<div id="wrapper">
	<div id="container">
		<div id="page">
			<h1>Catálogo de peliculas</h1>
		</div>
		<div class="row">
			@foreach( $arrayPeliculas ?? '' as $key => $pelicula )
			
			<div class="col-xs-6 col-sm-4 col-md-4 text-center">
				<a href="{{ url('/catalog/show/' . $pelicula->id) }}">
					<img src="" style="height:200px"/>
					<span style="min-height:45px;margin:5px 0 10px 0">
						{{$pelicula->title}}
					</span>
				</a>
				<a class="nav-link" href="{{url('/catalog/edit/'.$pelicula->id)}}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				</a>
				
				<form method="POST" class="" action="{{url('/catalog/borrar/'.$pelicula->id)}}">
					{{ method_field('DELETE') }}
					{{ csrf_field()}}
					<div class="field">
						<div class="control">
							<button type="submit" class="button">Delete</button>
						</div>
					</div>
				</form>
			</div>

		@endforeach
		</div>
	</div>	
		{{ $arrayPeliculas->links() }}
	
</div>

@stop