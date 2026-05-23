<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profil Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
            <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('siswa.profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-label for="nis" value="NIS" />
                        <x-input id="nis" name="nis" type="text" class="mt-1 block w-full" value="{{ old('nis', $siswa?->nis) }}" required autofocus />
                        <x-input-error for="nis" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="kelas" value="Kelas" />
                        <x-input id="kelas" name="kelas" type="text" class="mt-1 block w-full" value="{{ old('kelas', $siswa?->kelas) }}" required />
                        <x-input-error for="kelas" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat', $siswa?->alamat) }}</textarea>
                        <x-input-error for="alamat" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-button>Simpan</x-button>
                        <a href="{{ route('siswa.profile.show') }}">
                            <x-secondary-button>Batal</x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>