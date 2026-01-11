<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
   
    protected $table = 'peminjaman'; 
    
    protected $fillable = [
        'id_anggota', 'id_staff', 'tgl_pinjam', 'tgl_kembali',
    ];


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
}

