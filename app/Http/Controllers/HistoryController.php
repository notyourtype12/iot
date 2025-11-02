<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    // Tampilkan halaman riwayat + filter
   public function index(Request $request)
{
    $query = History::query();

    // Filter Grade
    if ($request->filled('grade')) {
        $query->where('grade', $request->grade);
    }

    // Filter Tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // Urutkan terbaru dulu
    $histories = $query->orderByDesc('tanggal')->get();

    // Tambahkan path foto otomatis
    foreach ($histories as $item) {
        $item->foto_url = asset('storage/foto/' . $item->foto); 
        // ganti 'foto' dengan nama kolom foto di tabelmu
    }

    return view('history.history', compact('histories'));
}

    // Hapus data (dipanggil via GET /history/delete/{id})
   public function destroy($id_history)
{
    // cari berdasarkan kolom id_history
    $history = History::where('id_history', $id_history)->first();

    // jika data tidak ditemukan
    if (!$history) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.'
        ], 404);
    }

    // hapus data
    $history->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}



}
