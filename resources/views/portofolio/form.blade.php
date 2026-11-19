<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item->exists ? 'Edit' : 'Tambah' }} Portofolio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ $item->exists ? route('portofolio.update', $item) : route('portofolio.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @if ($item->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="title" value="Judul Proyek" />
                        <x-text-input id="title" name="title" class="block mt-1 w-full" :value="old('title', $item->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="url" value="Link Proyek (opsional)" />
                        <x-text-input id="url" name="url" type="url" class="block mt-1 w-full" :value="old('url', $item->url)" />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" value="Gambar" />
                        @if ($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" class="w-32 rounded mb-2" alt="">
                        @endif
                        <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Simpan</x-primary-button>
                        <a href="{{ route('portofolio.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>