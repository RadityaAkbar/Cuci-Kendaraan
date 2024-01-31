<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PesananExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($dates)
    {
        $this->tgl_pesan = $dates;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Pesanan::query()->whereBetween('tgl_pesan', $this->tgl_pesan);
    }

    public function map($pesanan): array
    {
        return [
            $pesanan->tgl_pesan,
            $pesanan->no_pesanan,
            $pesanan->nama,
            $pesanan->plat_nomor,
            $pesanan->jeniscuci->name,
            $pesanan->kategori->name,
            $pesanan->harga_cuci,
            $pesanan->harga_kategori,
            $pesanan->subtotal,
            $pesanan->status->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'No.Pesanan',
            'Nama',
            'Plat Nomor',
            'Jenis Cuci',
            'Kategori',
            'Harga Cuci',
            'Harga Kategori',
            'Subtotal',
            'Status',

        ];
    }

}
