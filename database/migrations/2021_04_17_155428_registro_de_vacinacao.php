<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroDeVacinacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinaregistro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_vacina');
            $table->string('dataVacinacao');
            $table->string('cpfId');
            $table->string('idDose');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
