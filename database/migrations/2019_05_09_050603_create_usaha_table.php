<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user');
            $table->string('nama_usaha');
            $table->string('logo_usaha');
            $table->string('deskripsi_usaha');
            $table->string('foto_ktp');
            $table->string('foto_dengan_ktp');
            $table->string('siup');
            $table->string('id_provinsi');
            $table->string('id_kota');
            $table->string('kode_pos');
            $table->string('alamat_usaha');
            $table->integer('status_usaha');
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
        Schema::dropIfExists('usaha');
    }
}
