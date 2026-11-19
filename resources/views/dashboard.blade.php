<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                Halo, {{ Auth::user()->name }}. Kelola isi web portofolio kamu dari menu di bawah.
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('profil.edit') }}" class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-semibold text-lg">Profil</h3>
                    <p class="text-gray-600 text-sm mt-1">Foto, headline, tentang saya, dan kontak.</p>
                </a>
                <a href="{{ route('pendidikan.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-semibold text-lg">Riwayat Pendidikan</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ Auth::user()->educations()->count() }} data</p>
                </a>
                <a href="{{ route('pekerjaan.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-semibold text-lg">Riwayat Pekerjaan</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ Auth::user()->experiences()->count() }} data</p>
                </a>
                <a href="{{ route('portofolio.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md">
                    <h3 class="font-semibold text-lg">Portofolio</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ Auth::user()->portfolios()->count() }} data</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>