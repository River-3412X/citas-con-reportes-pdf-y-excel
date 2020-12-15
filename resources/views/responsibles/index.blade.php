@extends('layouts.layout')
@section('scripts')
<script src="{{ asset('js/eliminar/responsables.js') }}" type="text/javascript"></script>    
@endsection
@section('contenido')
    <h4 class="text-center">Responsables</h4>
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
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($responsables))
                    @foreach ($responsables as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->usuario }}</td>
                            <td>
                                <div class="d-flex" style="justify-content: center" id="forms">
                                    <a href="{{ route('edit_responsibles',$item->id) }}" class="btn btn-primary btn-sm mr-1" >Modificar</a>
                                    <form action="{{ route('destroy_responsibles',$item->id) }}" method="post" id="{{ $item->id }}">
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
        @if (isset($responsables))
           {{ $responsables->onEachSide(0)->links() }}
        @endif
    </div>
    
@endsection