@extends('layouts.layout')
@section('scripts')
    <script src="{{ asset('js/modificar/solicitantes.js') }}" type="text/javascript"></script>
@endsection
@section('contenido')
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2">
            <h4>Modificar Solicitantes</h4>
            <form method="post" id="formulario" autocomplete="off">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control form-control-sm is-valid" maxlength="100" value="{{ $solicitante->nombre }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_nombre"></strong></span>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="Telefono" class="form-control form-control-sm is-valid" value="{{ $solicitante->telefono }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_telefono"></strong></span>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    <textarea name="asunto" id="asunto" placeholder="Asunto" class="form-control form-control-sm is-valid">{!! str_replace("<br />","",$solicitante->asunto) !!}</textarea>
                    <span class="invalid-feedback" role="alert"><strong id="error_asunto"></strong></span>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo" class="form-control form-control-sm is-valid" maxlength="50" value="{{ $solicitante->correo }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_correo"></strong></span>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" placeholder="fecha" class="form-control form-control-sm is-valid" min="{{ $fecha_minima }}" value="{{ $fecha }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_fecha"></strong></span>
                </div>
                <div class="form-group">
                    <label for="hora">hora</label>
                    <input type="time" name="hora" id="hora" placeholder="hora" class="form-control form-control-sm is-valid" value="{{ $hora }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_hora"></strong></span>
                </div>
                <div class="form-group">
                    <label for="id_responsables">Responsable</label>
                    <select name="id_responsables" id="id_responsables" class="custom-select custom-select-sm">
                        @if ($responsables)
                            @foreach ($responsables as $item)
                                @if ($solicitante->id_responsables == $item->id )
                                    <option value="{{ $item->id }}" selected>Nombre:{{ $item->nombre }}  ||  Usuario:{{ $item->usuario }}</option>
                                @else
                                    <option value="{{ $item->id }}">Nombre:{{ $item->nombre }}  ||  Usuario:{{ $item->usuario }}</option>    
                                @endif
                                
                            @endforeach
                        @endif
                    </select>
                    <span class="invalid-feedback" role="alert"><strong id="error_correo"></strong></span>
                </div>
                <input type="submit" value="Registrar Responsable" class="btn btn-primary btn-sm"> 
            </form>
        </div>
    </div>
@endsection