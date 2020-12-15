<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class BinnacleController extends BaseController
{
    public $modelo;
    public function __construct(){
        $this->modelo=new \App\Models\Binnacle;
    }
    public function index(){
        $bitacoras = $this->modelo->paginate(20);
        return view("binnacles.index",compact("bitacoras"));
    }
}
