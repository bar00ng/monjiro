<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $attributes = [
        'fotobaju_satu' => 'null',
        'fotobaju_dua' => 'null',
        'fotobaju_tiga' => 'null'
    ];

    protected $fillable = [
        'nama',
        'warna',
        'harga',
        'kategori',
        'link_shop',
        'note',
        'ukuran',
        'fotobaju_satu',
        'fotobaju_dua',
        'fotobaju_tiga'
    ];
    protected $casts = [
        'ukuran' => 'array',
        'warna' => 'array'
    ];
}
