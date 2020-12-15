<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table="applicants";
    protected $primaryKey="id";
    protected $fillable=[
        "nombre","telefono","asunto","correo","fecha_hora","id_responsables"
    ];
    public function responsible(){
        return $this->belongsTo(\App\Models\Responsible::class,"id_responsables","id");
    }
    public function registrar(){
        if($this->where("id_responsables",$this->id_responsables)->count()>0 ){
            $citas=$this->select("fecha_hora")->where("id_responsables",$this->id_responsables)->get();
            $fechaNew = strtotime($this->fecha_hora);
            foreach($citas as $cita){
                $fechaStore = strtotime($cita->fecha_hora);
                if( $fechaNew > $fechaStore-3600 && $fechaNew < $fechaStore + 3600 ){
                    return "El responsable tiene cita a la hora: ".$cita->fecha_hora;
                }
            }
        }
        if($this->save()){
            return "Se Registró Solicitante Correctamente";
        }
        return "No se Registró Solicitante";
        
    }
    public function modificar(){
        return $this->update();
    }
    public function eliminar(){
        return $this->delete();
    }
    
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    public function setAsunto($asunto){
        $this->asunto=$asunto;
    }
    public function setCorreo($correo){
        $this->correo=$correo;
    }
    public function setFecha_hora($fecha_hora){
        $this->fecha_hora=$fecha_hora;
    }
    public function setId_responsables($id_responsables){
        $this->id_responsables=$id_responsables;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getAsunto(){
        return $this->asunto;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getFecha_hora(){
        return $this->fecha_hora;
    }
    public function getId_responsables(){
        return $this->id_responsables;
    }
}
