<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMerek extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notifikasi()
    {
        return $this->hasOne(Notifikasi::class, 'pendaftaran_merek_id', 'id');
    }
}
