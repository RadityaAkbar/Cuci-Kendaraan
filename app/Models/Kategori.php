<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'name',
        'harga'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'kategori_id', 'id');
    }
}
