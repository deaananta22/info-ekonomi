<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
   public function createRapat()
{
    return view('tambahrapat'); // file blade form tambah rapat
}

public function storeRapat(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'waktu' => 'required',
        'lokasi' => 'required|string|max:255',
    ]);

    // Simpan sementara ke session (karena belum pakai database)
    session()->push('rapats', (object) $validated);

    return redirect()->route('agenda')->with('success', 'Rapat berhasil ditambahkan!');
}

public function index()
{
    $rapats = session('rapats', [ // ambil dari session jika ada
        (object)[
            'judul' => 'Rapat Evaluasi Bulanan',
            'tanggal' => '2025-07-05',
            'waktu' => '09:00',
            'lokasi' => 'Ruang Rapat A'
        ]
    ]);

    $notulensis = [
        (object)[
            'judul' => 'Rapat Koordinasi',
            'tanggal' => '2025-06-30',
            'isi' => 'Pembahasan target mingguan dan progres tim.'
        ]
    ];

    return view('agenda', compact('rapats', 'notulensis'));
}
}