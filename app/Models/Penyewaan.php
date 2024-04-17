<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'tgl_sewa',
        'tgl_kembali',
        'status_pembayaran',
        'status_kembali',
        'total_harga'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detail()
    {
        return $this->hasMany(PenyewaanDetail::class);
    }
}
