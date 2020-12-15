@extends('layouts.layout')
@section('scripts')
    <script src="{{ asset('js/modificar/responsables.js') }}" type="text/javascript"></script>    
@endsection
@section('contenido')
    <div class="row">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2">
            <h4>Modificar Responsables</h4>
            <form method="post" id="formulario" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control form-control-sm is-valid" value="{{ $responsable->nombre }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_nombre"></strong></span>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control form-control-sm is-valid" value="{{ $responsable->usuario }}">
                    <span class="invalid-feedback" role="alert"><strong id="error_usuario"></strong></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control form-control-sm">
                    <span class="invalid-feedback" role="alert"><strong id="error_password"></strong></span>
                </div>
                <div class="form-group">
                    <label for="confirmacion_password">Confirmar Contraseña</label>
                    <input type="password" name="confirmacion_password" id="confirmacion_password" placeholder="Confirmar Contraseña" class="form-control form-control-sm">
                    <span class="invalid-feedback" role="alert"><strong id="error_confirmacion_password"></strong></span>
                </div>
                <input type="submit" value="Registrar Responsable" class="btn btn-primary btn-sm"> 
            </form>
        </div>
    </div>
@endsection