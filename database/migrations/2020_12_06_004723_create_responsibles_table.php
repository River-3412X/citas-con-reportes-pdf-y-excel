<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsiblesTable extends Migration
{
    public function up()
    {
        Schema::create('responsibles', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("nombre",100);
            $table->string("usuario",100);
            $table->text("password");
        });
    }
    public function down()
    {
        Schema::dropIfExists('responsibles');
    }
}
