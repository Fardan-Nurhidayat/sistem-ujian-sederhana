<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Mata Pelajaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mata-pelajaran.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-label for="nama" value="Nama Mata Pelajaran" />
                        <x-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{ old('nama') }}" required autofocus />
                        <x-input-error for="nama" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="kode" value="Kode" />
                        <x-input id="kode" name="kode" type="text" class="mt-1 block w-full" value="{{ old('kode') }}" required />
                        <x-input-error for="kode" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="kkm" value="KKM" />
                        <x-input id="kkm" name="kkm" type="number" min="0" max="100" class="mt-1 block w-full" value="{{ old('kkm') }}" required />
                        <x-input-error for="kkm" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="guru_id" value="Guru Pengampu" />
                        <select id="guru_id" name="guru_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Pilih guru pengampu</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}" @selected(old('guru_id')==$guru->id)>{{ $guru->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="guru_id" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-button>Simpan</x-button>
                        <a href="{{ route('mata-pelajaran.index') }}">
                            <x-secondary-button>Batal</x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>