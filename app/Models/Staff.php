<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff'; 
    
    protected $fillable = [
        'nama', 'email', 'no_hp', 'posisi',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_staff');
    }
}
