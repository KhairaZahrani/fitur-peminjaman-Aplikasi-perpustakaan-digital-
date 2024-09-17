<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
   
    public function index()
    {
        $ulasan = Ulasan::with('user', 'buku')->get(); 
        return view('ulasan.index', compact('ulasan'));
    }

    public function create()
    {
        $buku = Buku::all(); 
        $users = User::all();
        return view('ulasan.create', compact('buku','users'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'id_user' => 'required|exists:users,id_user',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|min:1|max:10',
        ]);


        Ulasan::create([
            'id_buku' => $request->input('id_buku'),
            'id_user' => $request->input('id_user'),
            'ulasan' => $request->input('ulasan'),
            'rating' => $request->input('rating'),
        ]);

        return redirect('/ulasan')->with('pesan', "Ulasan berhasil ditambahkan!");
    }

    public function show($id)
    {

    }

    public function edit($id)
{
    $data = Ulasan::where('id_ulasan', $id)->first();
    $buku = Buku::all(); 
    $users = User::all(); 

    return view('ulasan.edit', compact('data', 'buku', 'users'));
}

public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $request->validate([
        'id_buku' => 'required|exists:buku,id_buku',
        'id_user' => 'required|exists:users,id_user',
        'ulasan' => 'required|string',
        'rating' => 'required|integer|min:1|max:10',
    ]);

    // Temukan ulasan yang akan diperbarui
    $ulasan = Ulasan::find($id);

    // Perbarui data ulasan
    $ulasan->update([
        'id_buku' => $request->input('id_buku'),
        'id_user' => $request->input('id_user'),
        'ulasan' => $request->input('ulasan'),
        'rating' => $request->input('rating'),
    ]);

    // Redirect ke halaman index ulasan dengan pesan sukses
    return redirect('/ulasan')->with('pesan', 'Ulasan berhasil diperbarui!');
}


public function destroy($id)
{
    $buku = Ulasan::findOrFail($id);

    $buku->delete();
    
    return redirect('/ulasan')->with('pesan', 'Ulasan berhasil dihapus');
}
}
