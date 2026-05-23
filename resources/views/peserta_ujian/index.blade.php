<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Peserta Ujian
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $isTeacher ? 'Lihat daftar ujian dan buka penilaian untuk ujian yang sudah selesai.' : 'Lihat ujian yang sedang berlangsung dan riwayat ujian kamu.' }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('status'))
            <div class="rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Ujian</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $isTeacher ? 'Guru dapat membuka penilaian untuk ujian yang sudah selesai.' : 'Hanya ujian yang sedang berlangsung yang bisa diikuti.' }}
                </p>

                @if ($ujians->isEmpty())
                <div class="mt-4 text-sm text-gray-600">Belum ada ujian yang tersedia.</div>
                @else
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ujian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ujians as $ujian)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ujian->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $ujian->mataPelajaran?->nama ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $ujian->tanggal?->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $ujian->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    @if ($isTeacher && $ujian->status === 'Sudah Selesai')
                                    <a href="{{ route('peserta-ujian.penilaian.show', $ujian) }}">
                                        <x-secondary-button>Penilaian</x-secondary-button>
                                    </a>
                                    @elseif ($isStudent)
                                    @if ($ujian->status === 'Sedang Berlangsung')
                                    <a href="{{ route('peserta-ujian.show', $ujian) }}">
                                        <x-secondary-button>Lihat</x-secondary-button>
                                    </a>
                                    @elseif (in_array($ujian->id, $pesertaIds, true))
                                    <a href="{{ route('peserta-ujian.show', $ujian) }}">
                                        <x-secondary-button>Lihat Nilai</x-secondary-button>
                                    </a>
                                    @else
                                    <span class="text-sm text-gray-500">Tidak tersedia</span>
                                    @endif
                                    @else
                                    <span class="text-sm text-gray-500">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            @if ($isStudent)
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Ujian Saya</h3>
                <p class="mt-1 text-sm text-gray-600">Nilai akan tampil setelah guru selesai melakukan penilaian.</p>

                @if ($ujianSaya->isEmpty())
                <div class="mt-4 text-sm text-gray-600">Belum ada riwayat ujian.</div>
                @else
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ujian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ujianSaya as $peserta)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->ujian?->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->ujian?->mataPelajaran?->nama ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->nilai ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->status->label() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    @if ($peserta->nilai === null)
                                    Menunggu penilaian
                                    @elseif ($peserta->status === \App\Enums\StatusUjianSiswa::LULUS)
                                    Lulus KKM
                                    @else
                                    Belum lulus KKM
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>