<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganData extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'file'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
