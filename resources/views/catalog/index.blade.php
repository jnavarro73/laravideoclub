@extends('layouts.master')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montez&display=swap" rel="stylesheet"> 
<style>
		.roundedCornerBox
		{
		  width:480px;
		  border: solid 1px #555;
		  background-color: #362323;
		  box-shadow: 5px -5px 2px  rgba(0,0,0,0.2);
		  -moz-box-shadow: 5px -5px 2px  rgba(0,0,0,0.2);
		  -webkit-box-shadow: 5px -5px 2px  rgba(0,0,0,0.2);
		  -o-box-shadow: 5px -5px 2px  rgba(0,0,0,0.2);
		  border-radius:25px;
		}
		.roundCornerImage{
			border: solid 1px #555;
			border-radius:25px;
		}
		.titulomolon{

		}
		.abs-center {
		  display: flex;
		  /*align-items: center;*/
		  justify-content: center;
		  /*min-height: 100vh;*/
		}


</style>

<div id="wrapper">
	<!--<h1 class="text-hide" style="background-image: url('/images/palomitas.jpeg'); width: 400px; height: 200px;">Bootstrap</h1>	-->
	<div id="container ">
		<br><br><div id="page ">
			<h2>Catálogo de peliculas y series </h2>
		</div><br>

		<div class="row">
			@foreach( $arrayPeliculas ?? '' as $key => $pelicula )
			
			<div class="col-xs-4 col-sm-4 col-md-3 text-center m-2 roundedCornerBox">
				<div id="container">
					<div class="row  pt-1 " style="padding-left: 0px">
						<!--border border-alert-->
						<div class="col-xs-4 col-sm-4 col-md-6 text-center " style="padding-left: 5px; padding-right: 0px;padding-bottom: 5px;">
							<a href="{{ url('/catalog/show/' . $pelicula->id) }}">
								<!-- TODO decidir si montar un asset  o no dependiendo de si es externo o interno link -->
								<!--<img src="{{ asset('images/'.$pelicula->poster) }}" style="height:200px"/>-->
							
									<!--<img src="http://lorempixel.com/350/230/" style="height:200px"/>-->
									<img src="http://placeimg.com/160/260/any" class="roundCornerImage" style="height:250"/>
							</a>
						</div>	
						@php 
						$locale = App::getLocale();

						if (App::isLocale('es')) {
						   //echo $pelicula->title;
						}
						@endphp
						<div class="col-xs-4 col-sm-4 col-md-6   flex-column"  style="padding-left: 7px; padding-right: 0px;">
							<div class="btn-group btn-group-lg flex-column" >
								<p class="text-center"><a href="{{ url('/catalog/show/' . $pelicula->id) }}">
									<span style="min-height:45px;margin:5px 0 10px 0 ;color:white;font-family: 'Bungee Shade', cursive;">
										{{$pelicula->title}}
									</span>
									</a>
								</p><br>
								<p class="text-left mr-1">
									<span class="text-left font-weight-light" style="color:white;font-family: 'Montez', cursive;">{{  Str::limit($pelicula->synopsis,160 )}}</span>
								</p>

							</div>	
							<div class="btn-group btn-group-lg align-content-start" >	
								<a class="nav-link" href="{{url('/catalog/edit/'.$pelicula->id)}}">
									<!--<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>-->
									<button type="button" class=" btn btn-info">Edit</button>
								</a>
								
								<form method="POST" style="padding:.5rem 0rem;" action="{{url('/catalog/borrar/'.$pelicula->id)}}">
									{{ method_field('DELETE') }}
									{{ csrf_field()}}
									<div class="field">
										<div class="control">
											<button type="submit" class="btn btn-info">Del</button>
										</div>
									</div>
								</form>

							</div>
						</div>
				</div>
				</div>
			</div>
			
			@endforeach
		</div>
	</div>
	<div class="container  justify-content-center mt-3 pt-3 abs-center">
		<div class="w-25 justify-content-center ">	
			{{ $arrayPeliculas->links() }}
		</div>
	</div>
</div>

@stop
