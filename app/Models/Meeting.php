<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Kontributor: Gisella Laudila - Dokumentasi model Meeting
 */
class Meeting extends Model
{
    protected $table = 'meetings';
    protected $fillable = ['judul', 'tanggal', 'lokasi'];
}
