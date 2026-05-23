<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MataPelajaranController extends Controller
{
    public function index(): View
    {
        return view('mata_pelajaran.index', [
            'mataPelajarans' => MataPelajaran::with('guru')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('mata_pelajaran.create', [
            'gurus' => User::role('teacher')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $teacherIds = User::role('teacher')->pluck('id')->all();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255', 'unique:mata_pelajarans,kode'],
            'kkm' => ['required', 'integer', 'min:0', 'max:100'],
            'guru_id' => ['required', Rule::in($teacherIds)],
        ]);

        MataPelajaran::create($validated);

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('status', 'Mata pelajaran berhasil dibuat.');
    }

    public function edit(MataPelajaran $mataPelajaran): View
    {
        return view('mata_pelajaran.edit', [
            'mataPelajaran' => $mataPelajaran->load('guru'),
            'gurus' => User::role('teacher')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, MataPelajaran $mataPelajaran): RedirectResponse
    {
        $teacherIds = User::role('teacher')->pluck('id')->all();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255', Rule::unique('mata_pelajarans', 'kode')->ignore($mataPelajaran->id)],
            'kkm' => ['required', 'integer', 'min:0', 'max:100'],
            'guru_id' => ['required', Rule::in($teacherIds)],
        ]);

        $mataPelajaran->update($validated);

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('status', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mataPelajaran): RedirectResponse
    {
        $mataPelajaran->delete();

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('status', 'Mata pelajaran berhasil dihapus.');
    }
}
