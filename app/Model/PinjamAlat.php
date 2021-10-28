<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PinjamAlat extends Model
{
    //
    protected $fillable = [
        'praktikum', 'customer_id', 'nim','kelas','semester','tanggal_pinjam','tanggal_kembali',//'pro_id','nama_alat','jumlah_alat', 'keterangan'
    ];
}
