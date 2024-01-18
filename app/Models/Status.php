<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'status_id', 'id');
    }
}