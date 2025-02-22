<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\Pembeli;
use App\Models\Menu;
use App\Models\Kategori;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
public function boot()
{
    View::composer('*', function ($view) {
        $routeName = Route::currentRouteName();
        $title = 'Dashboard';

        // Mapping static title
        $titles = [
            'welcome' => 'dashboard',
            'pembeli.index' => 'Store',
            'kategori.index' => 'Kategori',
            'menu.index' => 'Menu',
        ];

        
        if (isset($titles[$routeName])) {
            $title = $titles[$routeName];
        }

        
        if ($routeName === 'pembeli.show') {
            $id = request()->route('pembeli'); 
            $pembeli = Pembeli::where('id', $id)->first(); 
            if ($pembeli) {
                $title = "Detail Pesanan - " . $pembeli->nama_pembeli;
            }
        } elseif ($routeName === 'menu.show') {
            $id = request()->route('menu');
            $menu = Menu::where('id', $id)->first(); 
            if ($menu) {
                $title = "Detail Menu - " . $menu->nama_menu;
            }
        } elseif ($routeName === 'kategori.show') {
            $id = request()->route('kategori');
            $kategori = Kategori::find($id);
            if ($kategori) {
                $title = "Kategori - " . $kategori->nama_kategori;
            }
        } elseif ($routeName === 'pembeli.price'){
            $title = "Total Pembelian";
        }
        elseif ($routeName === 'home'){
            $title = "Home";
        }


        $view->with('title', $title);
    });
}
}
