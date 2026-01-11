<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
   
    protected $table = 'anggota'; 
    
    
    protected $fillable = [
        'nama', 'no_hp', 'email', 'alamat', 'tgl_bergabung',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }
}

