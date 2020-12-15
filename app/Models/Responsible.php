<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class Responsible extends Authenticatable
{
    use HasFactory,Notifiable;
    public $timestamps=false;
    protected $table="responsibles";
    protected $primaryKey="id";
    protected $fillable = [
        'nombre',
        'usuario',
        'password',
    ];
    public function setNombre($nombre){
        $this->nombre= $nombre;
    }
    public function setUsuario($usuario){
        $this->usuario= $usuario;
    }
    public function setPassword($password){
        $this->password=Hash::make($password);
        return $this->password;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getPassword(){
        return $this->password;
    }

    public function registrar(){
        if($this->where("usuario","=",$this->usuario)->count()>0){
            return "Nombre de usuario Existente";
        }
        if($this->save()){
            return "Se registró el Responsable Correctamente";
        }
        return "No se registró el Responsable";
    }
    public function modificar(){
        if($this->where("usuario","=",$this->usuario)->where("id","<>",$this->id)->count()>0){
            return "Nombre de usuario Existente";
        }
        if($this->update()){
            return "Se Modificó Responsable Correctamente";
        }
        return "No se Eliminó Responsable";
    }
    public function eliminar(){
        if($this->applicant->count()>0){
            return "El Responsable tiene Citas Registradas";
        }
        else{
            if($this->delete()){
                return "Se Eliminó Responsable Correctamente";
            }
            return "No se Eliminó Responsable";
        }
    }
    public function applicant(){
        return $this->hasmany(\App\Models\Applicant::class,"id_responsables","id");
    }    
}

