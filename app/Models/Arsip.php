<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat',
        'kategori',
        'judul',
        'created_at',
        'updated_at'
    ];
}
