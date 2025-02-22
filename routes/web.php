<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Fixed import
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\MenuController;

// Route to the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Home route with controller
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('kategori', KategoriController::class);
Route::resource('menu', MenuController::class);
Route::get('price', [PembeliController::class, 'price'])->name('pembeli.price');
Route::delete('menu', [MenuController::class, 'deleteMultiple'])->name('menu.deleteMultiple');
Route::delete('kategori', [KategoriController::class, 'deletemultiple'])->name('kategori.deletemultiple');
Route::delete('pembeli', [PembeliController::class, 'deleteMultiple'])->name('pembeli.deleteMultiple');
Route::get('pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::post('pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
Route::get('pembeli/{pembeli}', [PembeliController::class, 'show'])->name('pembeli.show');
Route::delete('/pembeli/{pembeli}', [PembeliController::class, 'destroy'])->name('pembeli.destroy');




