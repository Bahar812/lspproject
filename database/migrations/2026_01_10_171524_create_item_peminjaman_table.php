<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPeminjamanTable extends Migration
{
    public function up()
    {
        Schema::create('item_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_buku');
            $table->date('tgl_kembali');
            $table->timestamps();

    
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_peminjaman');
    }
}
