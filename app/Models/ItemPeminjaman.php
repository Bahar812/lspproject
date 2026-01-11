<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPeminjaman extends Model
{
    
    protected $table = 'item_peminjaman';
    
    protected $fillable = [
        'id_buku', 'id_peminjaman', 'tgl_kembali',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}

