<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class ReportController extends BaseController
{
    public $modelo;
    public function __construct(){
        $this->modelo=new \App\Models\Report;
    }
    public function index(){
        date_default_timezone_set("America/Mexico_city");
        $fecha = Date("Y-m-d");
        $this->modelo= new \App\Models\Applicant;
        $sol=$this->modelo->all();
        $solicitantes=null;
        $indice= 0;
        foreach($sol as $solicitante){
            if(strtotime($solicitante->fecha_hora) > strtotime($fecha)  && strtotime($solicitante->fecha_hora) < (strtotime($fecha) + 86400) ){
                
                $solicitantes[$indice]=$solicitante;
                $indice++;
                
            }
        }
        $fecha= Date("d-m-Y");
        return view("reports.index",compact("solicitantes","fecha"));
    }
    public function pdf(){
        date_default_timezone_set("America/Mexico_city");
        $fecha = Date("Y-m-d");
        $this->modelo= new \App\Models\Applicant;
        $sol=$this->modelo->all();
        $solicitantes=null;
        $indice= 0;
        foreach($sol as $solicitante){
            if(strtotime($solicitante->fecha_hora) > strtotime($fecha)  && strtotime($solicitante->fecha_hora) < (strtotime($fecha) + 86400) ){
                
                $solicitantes[$indice]=$solicitante;
                $indice++;
                
            }
        }
        //return view("reports.pdf",compact("solicitantes"));
        //$pdf = App::make('dompdf.wrapper');
        //$pdf->loadHTML('<h1 class="text-center">Test</h1>');
        //$pdf= PDF::loadHTML("<h1 style='color:red'>text</h1>");
        
        $fecha_actual= Date("d-m-Y");
        $pdf= PDF::loadView("reports.pdf",compact("solicitantes","fecha_actual"));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function excel(){
        return Excel::download(new \App\Exports\BinnacleExport,"bitacora.xlsx");
    }
}
