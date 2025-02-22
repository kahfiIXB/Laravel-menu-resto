<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::with('kategori')->get();
        $kategoris = Kategori::all();

        return view('menu.index', compact('data', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('menu.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Menu::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
{
    $kategoris = Kategori::all();
    return view('menu.detail', compact('menu', 'kategoris',));
    $menu = Menu::with('pembelis')->findOrFail($id);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $kategoris = Kategori::all();
        return view('menu.edit', compact('menu', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $input = $request->all();
        $menu->update($input); 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = Menu::find($id);
        $data->delete();
        return back();
    }

   
public function deleteMultiple(Request $request)
{
    \Log::info('Data yang dikirim:', $request->all());

    $ids = $request->input('ids');

    if ($ids && is_array($ids)) {
        Menu::whereIn('id', $ids)->delete();

        return redirect()->route('menu.index')->with('success', 'Items deleted successfully.');
    }

    
    return redirect()->route('menu.index')->with('error', 'No items selected for deletion.');
}
}