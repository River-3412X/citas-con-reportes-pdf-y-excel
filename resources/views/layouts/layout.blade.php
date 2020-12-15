<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/inactividad.js') }}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-1" style="font-size:15px" id="barra_navegacion">
    <a class="navbar-brand pl-2" href="{{ route('create_responsibles') }}">Citas</a>
    <button class="navbar-toggler pl-1 pr-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span></button>
    

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto text-white">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="responsablesDropdown"role="button" data-toggle="dropdown">Responsables</a>
          <div class="dropdown-menu" aria-labelledby="responsablesDropdown">
            <a href="{{ route('create_responsibles') }}" class="dropdown-item" id="responsables_registrar">Registrar</a>  
            <div class="dropdown-divider"></div>
            <a href="{{ route('index_responsibles') }}" class="dropdown-item" id="responsables_consultar">Consultar</a>  
          </div>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="solicitantesDropdown" role="button" data-toggle="dropdown" >Solicitantes</a>
          <div class="dropdown-menu" aria-labelledby="solicitantesDropdown">
            <a href="{{ route('create_applicants') }}" class="dropdown-item " id="solicitantes_registrar">Registrar</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('index_applicants') }}" class="dropdown-item" id="solicitantes_consultar">Consultar</a>
          </div>
        </li>
        <li class="nav-item ">
          <a href="{{ route('index_reports') }}" class="nav-link" id="reportes">Reportes</a>
        </li>
        <li class="nav-item ">
          <a href="{{ route('index_binnacles') }}" class="nav-link" id="bitacora">Bitacora</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('close_session') }}" id="logout" class="nav-link">Cerrar Sesión</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" id="formulario_buscador" method="GET">
        <input class="form-control mr-sm-2" type="search" placeholder="¿Qué estás buscando?" aria-label="Search" name="consulta" id="consulta" value="@isset($consulta){{ $consulta }}@endisset">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </nav>

    <div class="container">
      @yield('contenido')
        

        <div class="modal fade" tabindex="-1" id="modal-success" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_success"></div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="modal-danger" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_danger"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>