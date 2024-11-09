<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Fixed import
use App\Http\Controllers\BarangController; // Fixed import

// Route to the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Home route with controller
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route to 'siswa' page
Route::get('siswa', function () {
    return view('siswa');
})->name('siswa');

// Route with parameter to display a message with a name
Route::get('about-studen/{nama}', function ($nama) {
    return "Ini kunci kesuksesan: " . $nama; 
    // Example: "about-studen/hannan" will display "Ini kunci kesuksesan: hannan"
});

// Route to 'detail' page with parameter
Route::get('detail/{nama}', function ($nama) {
    return view('detail', compact('nama'));
})->name('detail');

// Route to display a form
Route::get('form-siswa', function () {
    return view('form');
})->name('form-siswa');

// Route to handle form submission
Route::post('kirim-data', function (Request $request) {
    $data = $request->all();  // Retrieves all submitted data
    // Handle the data or perform any action here
    
    // Temporary output for debugging (you can replace with a redirect)
    return response()->json(['message' => 'Data received', 'data' => $data]);
})->name('kirim');


//Yang di butuh kan untuk CRUD

//-buat table di migrations (php artisan make:migration create_nama_table)
//-wajib migrate atau mengirimkan table ke data base(php artisan migrate)
//-wajib membuat model.
//-memerlukan controller
//-membuat ui
//-tentukan dulu routing, mulai penamaan dan action

Route::view('tampilan', 'template.template');


//route untuk menjalankan function index di barang controller
Route::get('barang',[BarangController::class,'index']);

//untuk menjalankan function store
Route::post('kirim-barang', [BarangController::class,'store'])->name('kirim-barang');
Route::get('barang/{param}', [BarangController::class,'show'])->name('detail-barang');
Route::delete('hapus-barang/{param}', [BarangController::class,'delete'])->name('hapus-barang');
Route::put('update-barang/{param}', [BarangController::class, 'update'])->name('update-barang');