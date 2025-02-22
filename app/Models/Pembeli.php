<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';
    protected $fillable = [
        'id_menu',
        'nama_pembeli',
        'nama_menu',
        'harga',
        'stok',
        'jumlah',
        'total_harga',
        'deskripsi_pembeli',
        'waktu_membeli',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }

}
