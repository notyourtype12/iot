<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim data ke view
        return view('profile', compact('user'));
    }
}
