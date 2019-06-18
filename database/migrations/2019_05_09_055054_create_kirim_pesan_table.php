<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKirimPesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kirim_pesan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_parent');
            $table->bigInteger('id_usaha');
            $table->bigInteger('id_user');
            $table->DateTime('tgl_pesan');
            $table->string('pesan');
            $table->string('balasan');            
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
        Schema::dropIfExists('kirim_pesan');
    }
}
