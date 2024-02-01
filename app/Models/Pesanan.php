<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'tgl_pesan',
        'jam_cuci',
        'no_pesanan',
        'nama',
        'plat_nomor',
        'jeniscuci_id',
        'kategori_id',
        'harga_cuci',
        'harga_kategori',
        'subtotal',
        'status_id',
        'user_id'
    ];
    
    public function jeniscuci()
    {
        return $this->belongsTo(Jeniscuci::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}
