<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
class ApplicantController extends BaseController
{
    public $modelo;
    public function __construct(){
        $this->modelo= new \App\Models\Applicant;
    }
    public function index(Request $request){
        if(isset($request->consulta)){
            $solicitantes= $this->modelo->select("applicants.id","applicants.nombre","telefono","asunto","correo","fecha_hora","id_responsables")
            ->join("responsibles","responsibles.id","like","applicants.id_responsables")
            ->orWhere("applicants.nombre","like","%".$request->consulta."%")
            ->orWhere("telefono","like","%".$request->consulta."%")
            ->orWhere("asunto","like","%".$request->consulta."%")
            ->orWhere("correo","like","%".$request->consulta."%")
            ->orWhere("fecha_hora","like","%".$request->consulta."%")
            ->orWhere("responsibles.usuario","like","%".$request->consulta."%")
            ->paginate(20)->withQueryString();
            $consulta=$request->consulta;
            if(count($solicitantes)==0){
                $mensaje="No se encontraron resultados para la busqueda '".$request->consulta."'";
                return view("applicants.index",compact("solicitantes","mensaje","consulta"));
            } 
            return view("applicants.index",compact("solicitantes","consulta"));
        }
        else{
            $solicitantes= $this->modelo->paginate(20);
            return view("applicants.index",compact("solicitantes"));
        }
    }
    public function create(){
        $this->modelo= new \App\Models\Responsible;
        $responsables=$this->modelo->select("id","nombre","usuario")->get();
        date_default_timezone_set("America/Mexico_city");
        $fecha_minima=Date("Y-m-d");
        return view("applicants.create",compact("responsables","fecha_minima"));
    }
    public function store(Request $request){
        $request->validate([
            "nombre"=>"required",
            "telefono"=>"required|min:10|max:10",
            "asunto"=>"required",
            "correo"=>"required|email",
            "fecha"=>"required|date",
            "hora"=>"required",
            "id_responsables"=>"required",
        ]);
        $this->modelo->setNombre(trim($request->nombre));
        $this->modelo->setTelefono(trim($request->telefono));
        $this->modelo->setAsunto(nl2br(trim($request->asunto)));
        $this->modelo->setCorreo(trim($request->correo));
        $this->modelo->setFecha_hora(trim($request->fecha." ".$request->hora));
        $this->modelo->setId_responsables(trim($request->id_responsables));

        $retorno = $this->modelo->registrar();
        if($retorno=="Se Registró Solicitante Correctamente"){
            $this->modelo= new \App\Models\Responsible;
            $responsable= $this->modelo->findOrFail($request->id_responsables);
            $this->modelo= new \App\Models\Binnacle;
            $descripcion= "El Responsable: ".Auth::guard("responsable")->user()->nombre." con el Usuario: ".Auth::guard("responsable")->user()->usuario." Registró una cita al Responsable: ".$responsable->getNombre()." con Usuario:".$responsable->getUsuario();
            $this->modelo->setDescripcion($descripcion);
            $this->modelo->registrar();
        }
        return $retorno;        
    }
    public function edit($id){
        $solicitante=$this->modelo->findOrFail($id);
        $this->modelo= new \App\Models\Responsible;
        $responsables=$this->modelo->all();
        date_default_timezone_set("America/Mexico_city");
        $fecha_minima=Date("Y-m-d");
        $fecha=explode(" ",$solicitante->fecha_hora)[0];
        $hora=explode(" ",$solicitante->fecha_hora)[1];
        return view("applicants.edit",compact("solicitante","responsables","fecha_minima","fecha","hora"));
    }
    public function update(Request $request){
        $request->validate([
            "nombre"=>"required",
            "telefono"=>"required|min:10|max:10",
            "asunto"=>"required",
            "correo"=>"required|email",
            "fecha"=>"required|date",
            "hora"=>"required",
            "id_responsables"=>"required",
        ]);
        $this->modelo=$this->modelo->findOrFail($request->id);
        $this->modelo->setNombre(trim($request->nombre));
        $this->modelo->setTelefono(trim($request->telefono));
        $this->modelo->setAsunto(nl2br(trim($request->asunto)));
        $this->modelo->setCorreo(trim($request->correo));
        $this->modelo->setFecha_hora(trim($request->fecha." ".$request->hora));
        $this->modelo->setId_responsables(trim($request->id_responsables));
        if($this->modelo->modificar()){
            $this->modelo= new \App\Models\Responsible;
            $responsable= $this->modelo->findOrFail($request->id_responsables);
            $this->modelo= new \App\Models\Binnacle;
            $descripcion= "El Responsable: ".Auth::guard("responsable")->user()->nombre." con el Usuario: ".Auth::guard("responsable")->user()->usuario." Modificó una cita al Responsable: ".$responsable->getNombre()." con Usuario:".$responsable->getUsuario();
            $this->modelo->setDescripcion($descripcion);
            $this->modelo->registrar();

            return "Se Modificó Solicitante Correctamente";
        }
        return "No se Modificó Solicitante";
    }
    public function destroy($id){
        $this->modelo=$this->modelo->findOrFail($id);
        if($this->modelo->eliminar()){
            $this->modelo= new \App\Models\Responsible;
            $responsable= $this->modelo->findOrFail($this->modelo->id_responsables);
            $this->modelo= new \App\Models\Binnacle;
            $descripcion= "El Responsable: ".Auth::guard("responsable")->user()->nombre." con el Usuario: ".Auth::guard("responsable")->user()->usuario." Eliminó una cita al Responsable: ".$responsable->getNombre()." con Usuario:".$responsable->getUsuario();
            $this->modelo->setDescripcion($descripcion);
            $this->modelo->registrar();
            return "Se Eliminó Solicitante Correctamente";
        }
        return "No se Eliminó Solicitante";
    }
}
