<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class ResponsibleController extends BaseController
{
    public $modelo;
    public function __construct(){
        $this->modelo=new \App\Models\Responsible;
    }
    public function reload(){
        return "reload";
    }
    public function login(){
        return view("login");
    }
    public function iniciar_sesion(Request $request){
        $request->validate([
            "usuario"=>"required",
            "contraseña"=>"required"
        ]);
        
        $credentials=[
            "usuario"=>$request->usuario,
            "password"=>$request->contraseña
        ];
        
        if(Auth::guard("responsable")->attempt($credentials)){
          return redirect()->route("login");
        }
        else{
            return back()->with([
                "mensaje"=>"Usuario o Contraseña Incorrecta",
                "usuario"=>$request->usuario,
                "contraseña"=>$request->contraseña
            ]);
        }
    }
    public function create(){
        return view("responsibles.create");
    }

    public function store(Request $request){
        $request->validate([
            "nombre"=>"required",
            "usuario"=>"required",
            "password"=>"required|min:8",
            "confirmacion_password"=>"required|min:8"
        ]);
        if($request->password!= $request->confirmacion_password){
            return "Las contraseñas no coinciden";
        }
        $this->modelo->setNombre(trim($request->nombre));
        $this->modelo->setUsuario(trim($request->usuario));
        $this->modelo->setPassword(trim($request->password));
        return $this->modelo->registrar();
    }
    public function index(Request $request){
        if(isset($request->consulta)){
            $responsables=$this->modelo->select("id","nombre","usuario")
            ->whereId($request->consulta)
            ->orWhere("nombre","like","%".$request->consulta."%")
            ->orWhere("usuario","like","%".$request->consulta."%")->paginate(20)->withQueryString();
            $consulta=$request->consulta;
            if(count($responsables)==0){
                $mensaje="No se encontraron resultados para la busqueda '".$consulta."'";
                return view("responsibles.index",compact("responsables","consulta","mensaje"));
            }
            return view("responsibles.index",compact("responsables","consulta"));
        }
        else{
            $responsables=$this->modelo->paginate(20);
            return view("responsibles.index",compact("responsables"));
        }
    }
    public function edit($id){
        $responsable= $this->modelo->findOrFail($id);
        return view("responsibles.edit",compact("responsable"));
    }
    public function update(Request $request){
        $request->validate([
            "nombre"=>"required",
            "usuario"=>"required",
            "password"=>"required|min:8",
            "confirmacion_password"=>"required|min:8"
        ]);
        if($request->password!= $request->confirmacion_password){
            return "Las contraseñas no coinciden";
        }
        $this->modelo= $this->modelo->findOrFail($request->id);
        $this->modelo->setNombre(trim($request->nombre));
        $this->modelo->setUsuario(trim($request->usuario));
        $this->modelo->setPassword(trim($request->password));
        return $this->modelo->modificar();
    }

    public function destroy($id){
        $this->modelo=$this->modelo->findOrFail($id);
        return $this->modelo->eliminar();
    }
    public function close_session(){
        Auth::guard("responsable")->logout();
        return redirect()->route("login");
    }
}
