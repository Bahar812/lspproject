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
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_anggota')->constrained()->onDelete('cascade');
        $table->foreignId('id_staff')->constrained()->onDelete('cascade');
        $table->date('tgl_pinjam');
        $table->date('tgl_kembali');
        $table->timestamps();
    });
}

public function anggota()
{
    return $this->belongsTo(Anggota::class, 'id_anggota');
}

public function staff()
{
    return $this->belongsTo(Staff::class, 'id_staff');
}

public function itemPeminjaman()
{
    return $this->hasMany(ItemPeminjaman::class, 'id_peminjaman');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
