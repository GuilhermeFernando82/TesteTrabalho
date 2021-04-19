<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vacina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacina', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fabricante');
            $table->string('lotes');
            $table->string('datadeValidade');
            $table->string('numerosdeDoses');
            $table->string('intervaloDoses');
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
