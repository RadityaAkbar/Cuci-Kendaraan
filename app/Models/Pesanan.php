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
        'metode_bayar',
        'status_id',
        'user_id'
    ];

    // public function scopeAvailable($query, $tanggal, $jam)
    // {
    //     return $query->where('tgl_pesan', $tanggal)
    //         ->where('jam_cuci', $jam)
    //         ->count() < 4;
    // }

    
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
