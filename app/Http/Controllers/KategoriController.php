<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return view('kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()  
    {  
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Kategori::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $data = Kategori::find($id);
        return view('kategori.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data = Kategori::find($id);
        $data->update($input);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Kategori::find($id);
        $data->delete();
        return back();
    }
    
public function deletemultiple(Request $request)
{
    \Log::info('Data yang dikirim:', $request->all());

    $idss = $request->input('idss');

    if ($idss && is_array($idss)) {
        Kategori::whereIn('id', $idss)->delete();

        return redirect()->route('kategori.index')->with('success', 'Items deleted successfully.');
    }

    return redirect()->route('kategori.index')->with('error', 'No items selected for deletion.');
}
}
