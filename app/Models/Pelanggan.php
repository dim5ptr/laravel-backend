<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'notelp',
        'email'
    ];

    public function data()
    {
        return $this->hasOne(PelangganData::class);
    }

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
