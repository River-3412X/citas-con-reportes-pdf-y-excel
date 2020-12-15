@extends('layouts.layout')
@section('scripts')
@endsection
@section('contenido')
    <h4 class="text-center">Bitacora</h4>
    <div class="overflow-auto w-100">
        <table class="table table-striped table-hover text-center table-sm" >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @if ($bitacoras)
                    @foreach ($bitacoras as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="text-left">{{ $item->descripcion }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @if ($bitacoras)
            {{ $bitacoras->links() }}
        @endif
    </div>
    <script type="text/javascript">
        $("#bitacora").addClass("active");
    </script>
@endsection