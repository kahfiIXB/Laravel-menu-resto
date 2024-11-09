<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    //definisikan tabel barang  dengan aplikasi laravel
    protected $table = 'barang';

    //definisikan nama column yang ada pada table barang
    protected $fillable = [
        'nama_barang', 'merek', 'harga', //kolumnya
    ];
}
