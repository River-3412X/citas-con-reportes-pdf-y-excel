<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\ResponsibleController::class,"login"])->name("login")->middleware("login");
Route::post("/",[App\Http\Controllers\ResponsibleController::class,"iniciar_sesion"])->name("iniciar_sesion");

Route::get("/reload",[App\Http\Controllers\ResponsibleController::class,"reload"])->name("reload");
Route::get("/reportes/excel",[App\Http\Controllers\ReportController::class,"excel"])->name("excel_reports")->middleware("usuarios:excel");

Route::group(["middleware"=>"usuarios"],function(){
    Route::get("/registrar/responsables",[App\Http\Controllers\ResponsibleController::class,"create"])->name("create_responsibles");
    Route::get("/consultar/responsables",[App\Http\Controllers\ResponsibleController::class,"index"])->name("index_responsibles");
    Route::get("/modificar/responsables/{id}",[App\Http\Controllers\ResponsibleController::class,"edit"])->name("edit_responsibles");
    Route::get("/logout",[App\Http\Controllers\ResponsibleController::class,"close_session"])->name("close_session");

    Route::get("/registrar/solicitantes",[App\Http\Controllers\ApplicantController::class,"create"])->name("create_applicants");
    Route::get("/consultar/solicitantes",[App\Http\Controllers\ApplicantController::class,"index"])->name("index_applicants");
    Route::get("/modificar/solicitantes/{id}/",[App\Http\Controllers\ApplicantController::class,"edit"])->name("edit_applicants");

    Route::get("/consultar/bitacoras",[App\Http\Controllers\BinnacleController::class,"index"])->name("index_binnacles");

    Route::get("/reportes",[App\Http\Controllers\ReportController::class,"index"])->name("index_reports");
    Route::get("/reportes/pdf",[App\Http\Controllers\ReportController::class,"pdf"])->name("pdf_reports");
    

});
Route::group(["middleware"=>"usuarios:POST"],function(){
    Route::post("/registrar/responsables",[App\Http\Controllers\ResponsibleController::class,"store"])->name("store_responsibles");
    Route::put("/modificar/responsables/{id}",[App\Http\Controllers\ResponsibleController::class,"update"])->name("update_responsibles");
    Route::delete("/eliminar/responsables/{id}",[App\Http\Controllers\ResponsibleController::class,"destroy"])->name("destroy_responsibles");

    Route::post("/registrar/solicitantes",[App\Http\Controllers\ApplicantController::class,"store"])->name("store_applicants");
    Route::put("/modificar/solicitantes/{id}",[App\Http\Controllers\ApplicantController::class,"update"])->name("update_applicants");
    Route::delete("/eliminar/solicitantes/{id}",[App\Http\Controllers\ApplicantController::class,"destroy"])->name("destroy_applicants");
});