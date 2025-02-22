<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Kategori extends Model
// {
//     protected $table = 'kategori';
//     protected $guarded;

//     public function kategori(): Hasone
//     {
//         return $this->hasOne(Kategori::class);
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori']; 

    public function menus() {
        return $this->hasMany(Menu::class, 'id_kategori');
    }
    
    
}
