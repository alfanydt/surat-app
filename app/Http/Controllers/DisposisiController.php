<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Auth;

class DisposisiController extends Controller
{
    public function store(Request $request, $surat_id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        Disposisi::create([
            'surat_id' => $surat_id,
            'komentar' => $request->komentar,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
