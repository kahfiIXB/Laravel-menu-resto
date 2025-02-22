<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $guarded;

    protected $fillable = ['nama_menu', 'harga', 'stok', 'deskripsi', 'id_kategori', 'waktu'];

    // Define the relationship to Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pembeli()
    {
        return $this->hasMany(Pembeli::class, 'id_menu', 'id');
    }
    
    
}