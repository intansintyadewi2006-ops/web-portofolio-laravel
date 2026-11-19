<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item->exists ? 'Edit' : 'Tambah' }} Riwayat Pekerjaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ $item->exists ? route('pekerjaan.update', $item) : route('pekerjaan.store') }}" class="space-y-4">
                    @csrf
                    @if ($item->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="company" value="Perusahaan / Organisasi" />
                        <x-text-input id="company" name="company" class="block mt-1 w-full" :value="old('company', $item->company)" required />
                        <x-input-error :messages="$errors->get('company')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="position" value="Posisi" />
                        <x-text-input id="position" name="position" class="block mt-1 w-full" :value="old('position', $item->position)" required />
                        <x-input-error :messages="$errors->get('position')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_date" value="Tanggal Mulai" />
                            <x-text-input id="start_date" name="start_date" type="date" class="block mt-1 w-full" :value="old('start_date', optional($item->start_date)->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="end_date" value="Tanggal Selesai (kosongkan jika masih)" />
                            <x-text-input id="end_date" name="end_date" type="date" class="block mt-1 w-full" :value="old('end_date', optional($item->end_date)->format('Y-m-d'))" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Simpan</x-primary-button>
                        <a href="{{ route('pekerjaan.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>