@extends('layouts.master')

@section('content')

<form action="{{ url('/catalog/edit/'.$oPelicula['id']) }}" method="POST" enctype="multipart/form-data">
	
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	<fieldset>
    <legend>Editar mensaje</legend>
    <div class="form-group">
		<label for="titulo" class="col-lg-label">Título</label>
		<div class="col-lg-10">
		    <input type="text" class="form-control" id="title" name="title" value="{!! $oPelicula['title'] !!}">
		</div>

   <div class="form-group">
      <label for="imagen" class="col-lag-label">Imagen</label>
       @if ( !empty($oPelicula['poster']) )
            <img src="{{ route('displayImage', $oPelicula['poster']) }}" alt="" title="" style="height:450px">
       @endif
       <input type="file" class="form-control" id="imagen" name="imagen" class="@error('imagen') is-invalid @enderror">
        @error('imagen')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
    </div> 
	<!--
        <label for="director" class="col-lg-label">Director</label>
		<div class="col-lg-10">
		    <input type="text" class="form-control" id="director" name="director" value="{!! $oPelicula['director'] !!}">
		</div>
    
        <label for="director" class="col-lg-label">Categoria</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="categoria" name="categoria" value="{!! $oPelicula['categoria'] !!}">
        </div>
    -->
		<div class="form-group">
            <label for="synopsis" class="col-lg-label">Sinopsis</label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="synopsis" 
                name="synopsis">{!! $oPelicula['synopsis'] !!}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="anyo" class="col-lg-label">Anyo</label>
            <div class="col-lg-10">

                <select id="year" name="year">
                	@for ($i = 1900; $i < $anyoActual; $i++)
					 <option value="{{ $i }}"{{ ( $oPelicula['year'] == $i ) ? ' selected' : '' }}>{{ $i }}</option>
					<!--<option value="{{$i}}" >{{$i}}</option>-->
					@endfor
                </select>
            </div>
        </div>
        <div class="form-group">        
           
             <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="novista" name="vista" @if (empty($oPelicula['vista'])) checked @endif required>
                <label class="custom-control-label" for="novista">No Vista</label>
              </div>
             <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="vista" name="vista" @if (!empty($oPelicula['vista'])) checked @endif required>
                <label class="custom-control-label" for="vista">Vista</label>
            </div>
        </div>
   
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
	            <button class="btn btn-default">Cancelar</button>
	            <button type="submit" class="btn btn-primary">Enviar</button>
        	</div>
        </div>
    </div>
	</fieldset>
</form>
@stop


