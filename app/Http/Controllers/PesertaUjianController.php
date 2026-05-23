<?php

namespace App\Http\Controllers;

use App\Enums\StatusUjianSiswa;
use App\Models\PesertaUjian;
use App\Models\Ujian;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PesertaUjianController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $siswaId = $user->siswa?->id;
        $isStudent = $user->hasRole('student');
        $isTeacher = $user->hasRole('teacher');

        $ujianQuery = Ujian::with('mataPelajaran')->latest('tanggal');

        if ($isStudent) {
            $ujianQuery->whereDate('tanggal', '>=', now()->toDateString());
        }

        $ujianSaya = collect();
        $pesertaIds = [];

        if ($isStudent && $siswaId) {
            $pesertaIds = PesertaUjian::where('siswa_id', $siswaId)->pluck('ujian_id')->all();

            $ujianSaya = PesertaUjian::with(['ujian.mataPelajaran'])
                ->where('siswa_id', $siswaId)
                ->latest()
                ->get();
        }

        return view('peserta_ujian.index', [
            'ujians' => $ujianQuery->get(),
            'ujianSaya' => $ujianSaya,
            'pesertaIds' => $pesertaIds,
            'isTeacher' => $isTeacher,
            'isStudent' => $isStudent,
        ]);
    }

    public function show(Ujian $ujian): View
    {
        $siswa = auth()->user()->siswa;

        abort_if(! auth()->user()->hasRole('student') || ! $siswa, 403);

        $peserta = PesertaUjian::with(['ujian.mataPelajaran'])
            ->where('siswa_id', $siswa->id)
            ->where('ujian_id', $ujian->id)
            ->first();

        return view('peserta_ujian.show', [
            'ujian' => $ujian->load('mataPelajaran', 'peserta.siswa.user'),
            'peserta' => $peserta,
        ]);
    }

    public function join(Ujian $ujian): RedirectResponse
    {
        $siswa = auth()->user()->siswa;

        abort_if(! auth()->user()->hasRole('student') || ! $siswa, 403);
        abort_if($ujian->status !== 'Sedang Berlangsung', 403);

        PesertaUjian::firstOrCreate([
            'siswa_id' => $siswa->id,
            'ujian_id' => $ujian->id,
        ]);

        return redirect()
            ->route('peserta-ujian.show', $ujian)
            ->with('status', 'Kamu berhasil terdaftar pada ujian ini.');
    }

    public function penilaianShow(Ujian $ujian): View
    {

        return view('peserta_ujian.penilaian.show', [
            'ujian' => $ujian->load(['mataPelajaran', 'peserta.siswa.user']),
        ]);
    }

    public function penilaianUpdate(Request $request, Ujian $ujian, PesertaUjian $pesertaUjian): RedirectResponse
    {

        $validated = $request->validate([
            'nilai' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $pesertaUjian->update($validated);

        return redirect()
            ->route('peserta-ujian.penilaian.show', $ujian)
            ->with('status', 'Nilai peserta berhasil disimpan.');
    }
}
