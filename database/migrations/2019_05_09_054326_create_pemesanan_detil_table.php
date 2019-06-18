<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananDetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_detil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_produk');
            $table->bigInteger('id_pemesanan');
            $table->integer('jumlah');
            $table->integer('harga_jual');
            $table->string('status_pemesanan');
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
        Schema::dropIfExists('pemesanan_detil');
    }
}
