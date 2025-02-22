<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
        
        public function index()
        {
            
            $menus = Menu::all();

            
            $pembeli = Pembeli::with('menu')->get();

            
            return view('pembeli.index', compact('menus', 'pembeli'));
        }

        
        public function store(Request $request)
{
    $request->validate([
        'nama_pembeli' => 'required|string|max:255',
        'id_menu' => 'required|exists:menu,id',
        'jumlah' => 'required|integer|min:1',
        'waktu_membeli' => 'required|date',
        'deskripsi_pembeli' => 'required|string',
    ]);

    $menu = Menu::findOrFail($request->id_menu);

    
    if ($menu->stok < $request->jumlah) {
        return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi!']);
    }

    
    $totalHarga = $menu->harga * $request->jumlah;

    
    $menu->stok -= $request->jumlah;
    $menu->save();

    
    Pembeli::create([
        'nama_pembeli' => $request->nama_pembeli,
        'id_menu' => $request->id_menu,
        'nama_menu' => $menu->nama_menu,
        'harga' => $menu->harga,
        'stok' => $menu->stok,
        'jumlah' => $request->jumlah,
        'total_harga' => $totalHarga,
        'waktu_membeli' => $request->waktu_membeli,
        'deskripsi_pembeli' => $request->deskripsi_pembeli,
    ]);

    return redirect()->route('pembeli.index')->with('success', 'Pembelian berhasil!');
}


    public function create()
    {
        $menus = Menu::all();
        return view('pembeli.create', compact('menus'));
    }

    /**
        * Display the specified resource.
        */
    public function show(Pembeli $pembeli)
    {
   
    return view('pembeli.detail', compact('pembeli'));
    }

    /**
        * Show the form for editing the specified resource.
        */
    public function edit(Pembeli $pembeli)
    {
        $menus = Menu::all();
        return view('pembeli.edit', compact('pembeli', 'menus'));
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(Request $request, Pembeli $pembeli)
    {
        $input = $request->all();
        $pembeli->update($input); 
        return back();
    }

    /**
        * Remove the specified resource from storage.
        */
        public function destroy($id)
        {
            $pembeli = Pembeli::findOrFail($id);
            $pembeli->delete();
        
            return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil dihapus!');
        }
    public function deleteMultiple(Request $request)
{
    
    \Log::info('Data yang dikirim:', $request->all());

    
    $idsss = $request->input('idsss');

    
    if ($idsss && is_array($idsss)) {
       
        Pembeli::whereIn('id', $idsss)->delete();

        
        return redirect()->route('pembeli.index')->with('success', 'Items deleted successfully.');
    }

    
    return redirect()->route('pembeli.index')->with('error', 'No items selected for deletion.');
}
public function price(Request $request)
{
    
    $tanggal = $request->input('waktu_membeli');
    $nama = $request->input('nama_pembeli');

    
    $pembelis = Pembeli::select('nama_pembeli', 'waktu_membeli')
        ->selectRaw('GROUP_CONCAT(DISTINCT nama_menu ORDER BY nama_menu ASC SEPARATOR ", ") as menu_nama')
        ->selectRaw('SUM(jumlah * harga) as total_harga')
        ->when($tanggal, function ($query) use ($tanggal) {
            return $query->whereDate('waktu_membeli', $tanggal);
        })
        ->when($nama, function ($query) use ($nama) {
            return $query->where('nama_pembeli', 'LIKE', "%{$nama}%");
        })
        ->groupBy('nama_pembeli', 'waktu_membeli')
        ->get();


    $TotalHarga = $pembelis->sum('total_harga');

    return view('pembeli.price', compact('pembelis', 'TotalHarga'));
}



}
