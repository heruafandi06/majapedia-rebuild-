<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskusiProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diskusi_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_parent');
            $table->bigInteger('id_produk');
            $table->bigInteger('id_user');
            $table->DateTime('tgl_diskusi');
            $table->string('diskusi');
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
        Schema::dropIfExists('diskusi_produk');
    }
}
