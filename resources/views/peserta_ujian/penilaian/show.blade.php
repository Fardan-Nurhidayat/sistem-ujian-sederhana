<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Penilaian {{ $ujian->nama }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">Masukkan nilai untuk setiap peserta yang mengikuti ujian ini.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
            <div class="rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                @if ($ujian->peserta->isEmpty())
                <div class="text-sm text-gray-600">Belum ada peserta pada ujian ini.</div>
                @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ujian->peserta as $peserta)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->siswa?->user?->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->siswa?->nis ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->siswa?->kelas ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <form method="POST" action="{{ route('peserta-ujian.penilaian.update', [$ujian, $peserta]) }}" class="flex items-center gap-3">
                                    @csrf
                                    @method('PUT')
                                    <x-input name="nilai" type="number" min="0" max="100" class="w-24" value="{{ old('nilai', $peserta->nilai) }}" required />
                                    <x-button>Simpan</x-button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $peserta->status->label() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>