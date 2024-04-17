<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
