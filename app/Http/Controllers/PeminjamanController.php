<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role == 'peminjam') {
            $peminjaman = Peminjaman::where('user_id', $user->id)->get();
            return view('peminjaman.index', compact('peminjaman'));
        }
        
        // Untuk role lain
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }
    

    public function create()
    {
        $users = User::all(); 
        $buku = Buku::all(); 
        return view('peminjaman.create', compact('users', 'buku'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:users,id_user',
        'id_buku' => 'required|exists:buku,id_buku',
        'tanggal_peminjaman' => 'required|date',
        'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        'status_peminjaman' => 'required'
    ]);

    Peminjaman::create([
        'id_user' => $validatedData['id_user'],
        'id_buku' => $validatedData['id_buku'],
        'tanggal_peminjaman' => $validatedData['tanggal_peminjaman'],
        'tanggal_pengembalian' => $validatedData['tanggal_pengembalian'],
        'status_peminjaman' => $validatedData['status_peminjaman'], 
    ]);

    return redirect()->route('peminjaman.index')->with('pesan', 'Peminjaman berhasil dibuat');
}

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
     public function edit($id)
     {
         $peminjaman = Peminjaman::with('user', 'buku')->findOrFail($id);
         $buku = Buku::all();
         return view('peminjaman.edit', compact('peminjaman', 'buku'));
     }
     
     public function update(Request $request, $id)
     {
         $validatedData = $request->validate([
             'id_buku' => 'required|exists:buku,id_buku',
             'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
             'status_peminjaman' => 'required'
         ]);
     
         $peminjaman = Peminjaman::findOrFail($id);
         $peminjaman->update($validatedData);
     
         return redirect()->route('peminjaman.index')->with('pesan', 'Peminjaman berhasil diperbarui');
     }
     

    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->firstOrFail(); 

        $peminjaman->delete();

        return redirect('/peminjaman')->with('pesan', 'Peminjaman berhasil dihapus');
    }
}
