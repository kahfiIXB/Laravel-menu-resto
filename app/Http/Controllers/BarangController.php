<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index() {
        //deklarasi variabel untuk menambung data
        $data = Barang::all(); 
        return view('barang.index', compact('data'));
        

    }

    //fungsi untuk menyimpan data ke tabel
    public function store(Request $request) {
        //variabel untuk memanggil data yang di simpan di request
        $data = $request->all();
        Barang::create($data);
        return back();
    }

    public function show ($id){
        $data = Barang::find($id);
        return view('barang.detail', compact('data'));      
    }

    public function update(Request $request, $id){
        $input = $request->all(); //untuk mengambil nilai yang di inputkan 
        $data = Barang::find($id);// mencari data yang spesifik untuk di ganti (berdasarkan id)
        $data->update($input);//mengupdate data lama dengan yang baru yang diambil dari $input

        return back()->with('gg bang', 'data','berhasil', 'di update');
    }

    public function delete($id){
        $data = Barang::find($id);
        $data->delete();
        return back()->with('data','berhaasio', 'delete');
    }
}

