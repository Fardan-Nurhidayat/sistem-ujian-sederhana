<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Ujian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
            <div class="rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $ujian->nama }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $ujian->mataPelajaran?->nama ?? '-' }} • {{ $ujian->tanggal?->format('d M Y') }}</p>
                </div>

                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-lg border border-gray-200 p-4">
                        <dt class="text-sm font-medium text-gray-500">Status Ujian</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $ujian->status }}</dd>
                    </div>

                    <div class="rounded-lg border border-gray-200 p-4">
                        <dt class="text-sm font-medium text-gray-500">KKM</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $ujian->mataPelajaran?->kkm ?? '-' }}</dd>
                    </div>
                </dl>

                @if ($peserta)
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    Kamu sudah terdaftar pada ujian ini.
                    @if ($peserta->nilai !== null)
                    <span class="block mt-1">Nilai kamu: {{ $peserta->nilai }}. Status: {{ $peserta->status->label() }}.</span>
                    @endif
                </div>
                @elseif ($ujian->status === 'Sedang Berlangsung')
                <form method="POST" action="{{ route('peserta-ujian.join', $ujian) }}">
                    @csrf
                    <x-button>Ikut Ujian</x-button>
                </form>
                @else
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-800">
                    Ujian ini belum bisa diikuti.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>