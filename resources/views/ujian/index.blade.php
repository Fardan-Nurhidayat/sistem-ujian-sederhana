<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Ujian
                </h2>
                <p class="mt-1 text-sm text-gray-600">Kelola jadwal ujian berdasarkan mata pelajaran yang sudah dibuat.</p>
            </div>

            <a href="{{ route('ujian.create') }}">
                <x-button>Tambah Ujian</x-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
            <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                @if ($ujians->isEmpty())
                <div class="p-6 text-sm text-gray-600">
                    Belum ada ujian yang dibuat.
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
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
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('ujian.edit', $ujian) }}">
                                            <x-secondary-button>Edit</x-secondary-button>
                                        </a>

                                        <button type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" x-data @click="$dispatch('open-delete-modal-{{ $ujian->id }}')">
                                            Hapus
                                        </button>
                                    </div>

                                    <div x-data="{ open: false }" x-on:open-delete-modal-{{ $ujian->id }}.window="open = true" x-on:close.stop="open = false" x-on:keydown.escape.window="open = false">
                                        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0" style="display: none;">
                                            <div x-show="open" class="fixed inset-0 bg-gray-500 opacity-75" x-on:click="open = false"></div>

                                            <div x-show="open" class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto" x-trap.inert.noscroll="open">
                                                <div class="px-6 py-4">
                                                    <div class="text-lg font-medium text-gray-900">
                                                        Hapus Ujian
                                                    </div>

                                                    <div class="mt-4 text-sm text-gray-600">
                                                        Data ujian ini akan dihapus permanen. Lanjutkan?
                                                    </div>
                                                </div>

                                                <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end gap-3">
                                                    <x-secondary-button @click="open = false">Batal</x-secondary-button>
                                                    <form method="POST" action="{{ route('ujian.destroy', $ujian) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button>Hapus</x-danger-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>