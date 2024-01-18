<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeniscuci extends Model
{
    use HasFactory;

    protected $table = 'jeniscuci';

    protected $fillable = [
        'name',
        'harga'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'jeniscuci_id', 'id');
    }
}
