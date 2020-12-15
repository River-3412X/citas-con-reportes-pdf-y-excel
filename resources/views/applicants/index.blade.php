@extends('layouts.layout')
@section('scripts')
<script src="{{ asset('js/eliminar/solicitantes.js') }}" type="text/javascript"></script>    
@endsection
@section('contenido')
    <h4 class="text-center">Solicitantes</h4>
    @isset($mensaje)
        <div class="alert alert-danger alert-danger-sm p-1">
            {{ $mensaje }}
        </div>
    @endisset
    <div class="overflow-auto w-100">
        <table class="table table-striped table-hover text-center table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Asunto</th>
                    <th>Correo</th>
                    <th>Fecha y Hora</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($solicitantes))
                    @foreach ($solicitantes as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->telefono }}</td>
                            <td style="min-width:350px">{!! $item->asunto !!}</td>
                            <td>{{ $item->correo }}</td>
                            <td>{{ $item->fecha_hora }}</td>
                            <td>{{ $item->responsible->usuario }}</td>
                            <td>
                                <div class="d-flex" style="justify-content: center" id="forms">
                                    <a href="{{ route('edit_applicants',$item->id) }}" class="btn btn-primary btn-sm mr-1" >Modificar</a>
                                    <form action="{{ route('destroy_applicants',$item->id) }}" method="post" id="{{ $item->id }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @if (isset($solicitantes))
            {{ $solicitantes->links() }}
        @endif
    </div>
    
@endsection