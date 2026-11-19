<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item->exists ? 'Edit' : 'Tambah' }} Riwayat Pendidikan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ $item->exists ? route('pendidikan.update', $item) : route('pendidikan.store') }}" class="space-y-4">
                    @csrf
                    @if ($item->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="institution" value="Institusi" />
                        <x-text-input id="institution" name="institution" class="block mt-1 w-full" :value="old('institution', $item->institution)" required />
                        <x-input-error :messages="$errors->get('institution')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="major" value="Jurusan" />
                        <x-text-input id="major" name="major" class="block mt-1 w-full" :value="old('major', $item->major)" />
                        <x-input-error :messages="$errors->get('major')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_year" value="Tahun Mulai" />
                            <x-text-input id="start_year" name="start_year" type="number" class="block mt-1 w-full" :value="old('start_year', $item->start_year)" required />
                            <x-input-error :messages="$errors->get('start_year')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="end_year" value="Tahun Selesai (kosongkan jika masih berjalan)" />
                            <x-text-input id="end_year" name="end_year" type="number" class="block mt-1 w-full" :value="old('end_year', $item->end_year)" />
                            <x-input-error :messages="$errors->get('end_year')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Simpan</x-primary-button>
                        <a href="{{ route('pendidikan.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>