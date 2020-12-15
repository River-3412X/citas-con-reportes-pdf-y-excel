<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinnaclesTable extends Migration
{
    public function up()
    {
        Schema::create('binnacles', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("descripcion");
        });
    }

    public function down()
    {
        Schema::dropIfExists('binnacles');
    }
}
