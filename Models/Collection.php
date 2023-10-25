<?php

namespace App\Models;
// NOVAL ABDURRAMADAN 6706223103 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
  
    use HasFactory;
    protected $fillable = [
        'namaKoleksi',
        'jenisKoleksi',
        'jumlahKoleksi'
    ];
    const CREATED_AT = 'createdAt'; //untuk menunjuk column created_at yang dibuat otomatis ke column createdAt
}
