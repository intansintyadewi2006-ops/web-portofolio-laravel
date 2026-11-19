<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Pekerjaan</h2>
            <a href="{{ route('pekerjaan.create') }}" class="px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700">Tambah</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-4 py-3">Perusahaan</th>
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Periode</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-3">{{ $item->company }}</td>
                                <td class="px-4 py-3">{{ $item->position }}</td>
                                <td class="px-4 py-3">
                                    {{ $item->start_date->format('M Y') }} - {{ $item->end_date ? $item->end_date->format('M Y') : 'Sekarang' }}
                                </td>
                                <td class="px-4 py-3 flex gap-3">
                                    <a href="{{ route('pekerjaan.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('pekerjaan.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>