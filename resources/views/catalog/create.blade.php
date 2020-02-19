@extends('layouts.master')
@section('content')
@section ('title') titlCrear Pelicula @stop

<h1>Crear Pelicula</h1>

<form action="{{ url('/catalog/create') }}" method="POST">1
  
  {{ method_field('PUT') }}
  {{ csrf_field() }}
 
  <fieldset>
    <legend>Editar mensaje</legend>
    <div class="form-group">
    <label for="titulo" class="col-lg-label">Título</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" id="title" name="title" class="@error('title') is-invalid @enderror">

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    </div>
    <label for="director" class="col-lg-label">Director</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" id="director" name="director" class="@error('director') is-invalid @enderror">

@error('director')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    </div>
    <div class="form-group">
            <label for="synopsis" class="col-lg-label">Sinopsis</label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="synopsis" 
                name="synopsis" class="@error('synopsis') is-invalid @enderror"></textarea>
                @error('synopsis')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
            </div>
        </div>
        <div class="form-group">
            <label for="anyo" class="col-lg-label">Anyo</label>
            <div class="col-lg-10">
                <select id="year" name="year">
                  @for ($i = 1900; $i <= $anyoActual; $i++)
                   <option value="{{ $i }}" {{($i == $anyoActual) ? " selected='selected'" : ""}}>{{ $i }}</option>
                  @endfor
                </select>
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
