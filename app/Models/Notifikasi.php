<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pendaftaranMerek()
    {
        return $this->belongsTo(PendaftaranMerek::class, 'pendaftaran_merek_id');
    }
}
