<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    use HasFactory;

    protected $fillable = [
        'namabank',
        'alamat',
        'jam_operasional',
        'call_center',
        'latitude',
        'longitude',
    ];
}
