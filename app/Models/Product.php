<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
