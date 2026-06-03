<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::paginate(10);
        return view('peminjam.index', compact('peminjams'));
    }
}
