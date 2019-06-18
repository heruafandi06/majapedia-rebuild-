<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimanProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_usaha');
            $table->bigInteger('id_pemesanan');
            $table->DateTime('tgl_kirim');
            $table->string('no_resi');
            $table->string('status_pengiriman');
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
        Schema::dropIfExists('pengiriman_produk');
    }
}
