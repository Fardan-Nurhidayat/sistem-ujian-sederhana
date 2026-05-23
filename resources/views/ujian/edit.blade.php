<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Ujian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('ujian.update', $ujian) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-label for="nama" value="Nama Ujian" />
                        <x-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{ old('nama', $ujian->nama) }}" required autofocus />
                        <x-input-error for="nama" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="mata_pelajaran_id" value="Mata Pelajaran" />
                        <select id="mata_pelajaran_id" name="mata_pelajaran_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Pilih mata pelajaran</option>
                            @foreach ($mataPelajarans as $mataPelajaran)
                            <option value="{{ $mataPelajaran->id }}" @selected(old('mata_pelajaran_id', $ujian->mata_pelajaran_id) == $mataPelajaran->id)>
                                {{ $mataPelajaran->nama }} ({{ $mataPelajaran->kode }})
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="mata_pelajaran_id" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="tanggal" value="Tanggal Pelaksanaan" />
                        <x-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" value="{{ old('tanggal', $ujian->tanggal?->format('Y-m-d')) }}" required />
                        <x-input-error for="tanggal" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-button>Simpan Perubahan</x-button>
                        <a href="{{ route('ujian.index') }}">
                            <x-secondary-button>Batal</x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>