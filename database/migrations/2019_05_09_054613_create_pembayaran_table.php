<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_pemesanan');
            $table->DateTime('tgl_pembayaran');
            $table->string('no_rekening')->default(null);
            $table->string('nama_pembayar')->default(null);
            $table->integer('jumlah_pembayaran')->default(null);
            $table->string('bank')->default(null);
            $table->string('alasan_penolakan')->default(null);
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
        Schema::dropIfExists('pembayaran');
    }
}
