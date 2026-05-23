<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function show(): View
    {
        return view('siswa.show', [
            'siswa' => auth()->user()->siswa,
        ]);
    }

    public function edit(): View
    {
        return view('siswa.edit', [
            'siswa' => auth()->user()->siswa,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'kelas' => ['required', 'string', 'max:255'],
        ]);

        Siswa::updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated + ['user_id' => $request->user()->id]
        );

        return redirect()
            ->route('siswa.profile.show')
            ->with('status', 'Profil siswa berhasil disimpan.');
    }
}
