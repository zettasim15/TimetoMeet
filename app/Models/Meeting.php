<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';
    protected $fillable = ['judul', 'tanggal', 'lokasi'];
}
