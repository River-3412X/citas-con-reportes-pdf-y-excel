@extends('layouts.layout')
@section('scripts')
    <script type="text/javascript">
        $().ready(function(){
            $("#reportes").addClass("active");
            $("#formulario_buscador").addClass("d-none");
            $("#barra_navegacion").removeClass("navbar-expand-lg");
            $("#barra_navegacion").addClass("navbar-expand-md");
        });
    </script>    
@endsection
@section('contenido')
    <div class="row justify-content-end pr-3">
        <a href="{{ route('pdf_reports') }}" target="_blank" class="btn btn-danger mr-1 mt-1 mb-1">Descargar Pdf</a>
        <a href="{{ route('excel_reports') }}" target="_blank" class="btn btn-success mt-1 mb-1">Descargar Excel</a>
    </div>
    <div class="row">
        <div class="col">
            <h4 class="text-center">Reporte de Citas del dia {{ $fecha }}</h4>
            <div class="overflow-auto">
                <table class="table table-stripped table-sm">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Asunto</th>
                            <th>Correo</th>
                            <th>Fecha</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($solicitantes))
                            @foreach ($solicitantes as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->telefono }}</td>
                                    <td>{!! $item->asunto !!}</td>
                                    <td>{{ $item->correo }}</td>
                                    <td>{{ $item->fecha_hora }}</td>
                                    <td>{{ $item->responsible->usuario }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection