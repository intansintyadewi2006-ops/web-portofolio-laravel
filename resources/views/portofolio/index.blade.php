<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Portofolio</h2>
            <a href="{{ route('portofolio.create') }}" class="px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700">Tambah</a>
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
                            <th class="px-4 py-3">Gambar</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Link</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-3">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}" class="w-16 h-12 object-cover rounded" alt="">
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item->title }}</td>
                                <td class="px-4 py-3">
                                    @if ($item->url)
                                        <a href="{{ $item->url }}" target="_blank" class="text-indigo-600 hover:underline">Buka</a>
                                    @endif
                                </td>
                                <td class="px-4 py-3 flex gap-3">
                                    <a href="{{ route('portofolio.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('portofolio.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')">
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
