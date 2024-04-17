<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'alat_id',
        'jumlah',
        'subharga'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
