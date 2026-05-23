<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UjianController extends Controller
{
    public function index(): View
    {
        return view('ujian.index', [
            'ujians' => Ujian::with('mataPelajaran')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('ujian.create', [
            'mataPelajarans' => MataPelajaran::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'tanggal' => ['required', 'date'],
        ]);

        Ujian::create($validated);

        return redirect()
            ->route('ujian.index')
            ->with('status', 'Ujian berhasil dibuat.');
    }

    public function edit(Ujian $ujian): View
    {
        return view('ujian.edit', [
            'ujian' => $ujian->load('mataPelajaran'),
            'mataPelajarans' => MataPelajaran::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Ujian $ujian): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'tanggal' => ['required', 'date'],
        ]);

        $ujian->update($validated);

        return redirect()
            ->route('ujian.index')
            ->with('status', 'Ujian berhasil diperbarui.');
    }

    public function destroy(Ujian $ujian): RedirectResponse
    {
        $ujian->delete();

        return redirect()
            ->route('ujian.index')
            ->with('status', 'Ujian berhasil dihapus.');
    }
}
