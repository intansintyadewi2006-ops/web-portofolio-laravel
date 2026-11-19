<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profil Portofolio</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @if ($profile->photo)
                        <img src="{{ asset('storage/'.$profile->photo) }}" class="w-24 h-24 rounded-full object-cover" alt="Foto">
                    @endif

                    <div>
                        <x-input-label for="photo" value="Foto" />
                        <input id="photo" name="photo" type="file" accept="image/*" class="block mt-1 w-full text-sm">
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="full_name" value="Nama Lengkap" />
                        <x-text-input id="full_name" name="full_name" class="block mt-1 w-full" :value="old('full_name', $profile->full_name ?? auth()->user()->name)" required />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="headline" value="Headline (mis. Mahasiswa Teknik Elektro)" />
                        <x-text-input id="headline" name="headline" class="block mt-1 w-full" :value="old('headline', $profile->headline)" />
                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="about" value="Tentang Saya" />
                        <textarea id="about" name="about" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('about', $profile->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email Kontak" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $profile->email ?? auth()->user()->email)" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="No. Telepon" />
                        <x-text-input id="phone" name="phone" class="block mt-1 w-full" :value="old('phone', $profile->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="address" value="Alamat" />
                        <x-text-input id="address" name="address" class="block mt-1 w-full" :value="old('address', $profile->address)" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <x-primary-button>Simpan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>