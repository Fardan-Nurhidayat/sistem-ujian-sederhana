<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
            <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                            <p class="mt-1 text-sm text-gray-600">Lengkapi data siswa agar dapat mengikuti proses ujian dengan benar.</p>
                        </div>

                        <a href="{{ route('siswa.profile.edit') }}">
                            <x-secondary-button>Edit Profil</x-secondary-button>
                        </a>
                    </div>

                    @if (! $siswa)
                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-800">
                        Profil siswa belum dilengkapi.
                    </div>
                    @else
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-lg border border-gray-200 p-4">
                            <dt class="text-sm font-medium text-gray-500">Nama</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</dd>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</dd>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4">
                            <dt class="text-sm font-medium text-gray-500">NIS</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $siswa->nis }}</dd>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4">
                            <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $siswa->kelas }}</dd>
                        </div>

                        <div class="rounded-lg border border-gray-200 p-4 sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $siswa->alamat }}</dd>
                        </div>
                    </dl>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>