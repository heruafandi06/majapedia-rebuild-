<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenarikanDanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penarikan_dana', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_usaha');
            $table->DateTime('tgl_penarikan');
            $table->string('rekening_penarikan');
            $table->string('bank');
            $table->integer('jumlah');
            $table->string('status_penarikan');
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
        Schema::dropIfExists('penarikan_dana');
    }
}
