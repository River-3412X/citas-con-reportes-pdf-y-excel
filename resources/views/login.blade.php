<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Citas</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <style>
            #panel{
                background:rgba(255, 255, 255, 0.5);
                border-radius:15px;
                padding:30px;
            }
            #panel img{
                width: 160px;
                display:block;
                margin:auto;
            }
        </style>
        <div class="container">
            <div class="row align-items-center vh-100">
                <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4 shadow-lg" id="panel"> 
                    <img src="{{ asset('img/user.png') }}">
                    <form method="post" autocomplete="off">
                        @csrf
                        @if(session('mensaje'))
                            <div class="alert alert-danger p-1">
                                {{ session('mensaje') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" id="usuario" name="usuario" placeholder="Usuario" class="form-control @error('usuario') is-invalid @enderror" value="@if(session('usuario')){{ session('usuario') }}@else{{ old('usuario') }}@endif">
                            @error('usuario')
                                <span class="invalid-feedback" role="alert">
                                    @foreach ($errors->get('usuario') as $item)
                                        <strong>{{ $item }}</strong>
                                    @endforeach
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" class="form-control @error('contraseña') is-invalid @enderror" value="@if(session('contraseña')){{ session('contraseña') }}@else{{ old('contraseña') }}@endif">
                            <span class="invalid-feedback">
                                @foreach (  $errors->get("contraseña") as $item)
                                    {{ $item }}
                                @endforeach
                            </span>
                        </div>
                        <div class="form-row">
                            <input type="submit" class="btn btn-primary d-block w-100" value="Iniciar Sesión">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
