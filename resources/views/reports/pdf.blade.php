<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<h3 class="text-center">Reporte de Citas con Fecha {{ $fecha_actual }}</h3>
<table class="table table-striped text-center table-sm">
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
                    <td class="text-left">{!! $item->asunto !!}</td>
                    <td>{{ $item->correo }}</td>
                    <td>{{ $item->fecha_hora }}</td>
                    <td>{{ $item->responsible->usuario }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>