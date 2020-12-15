<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("nombre",100);
            $table->unsignedBigInteger("telefono");
            $table->text("asunto");
            $table->string("correo",50);
            $table->dateTime("fecha_hora");
            $table->unsignedBigInteger("id_responsables");
            $table->foreign("id_responsables")->references("id")->on("responsibles");
        });
    }
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
