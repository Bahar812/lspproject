<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('item_peminjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_buku')->constrained()->onDelete('cascade');
        $table->foreignId('id_peminjaman')->constrained()->onDelete('cascade');
        $table->date('tgl_kembali');
        $table->timestamps();
    });
}

public function peminjaman()
{
    return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
}

public function buku()
{
    return $this->belongsTo(Buku::class, 'id_buku');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_peminjamen');
    }
};
