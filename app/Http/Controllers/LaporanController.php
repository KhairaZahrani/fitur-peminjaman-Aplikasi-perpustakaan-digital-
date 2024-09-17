<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function cetak()
{
    $peminjaman = Peminjaman::with('user', 'buku')->get(); 
    return view('peminjaman.cetak', compact('peminjaman'));
}
}
