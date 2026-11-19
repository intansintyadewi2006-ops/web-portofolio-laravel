<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->full_name ?? 'Portofolio' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">

    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="font-semibold">{{ $profile->full_name ?? 'Portofolio' }}</a>
            <div class="flex items-center gap-5 text-sm">
                <a href="#tentang" class="hover:underline">Tentang</a>
                <a href="#pendidikan" class="hover:underline">Pendidikan</a>
                <a href="#pekerjaan" class="hover:underline">Pekerjaan</a>
                <a href="#portofolio" class="hover:underline">Portofolio</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-1.5 bg-gray-800 text-white rounded-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 bg-gray-800 text-white rounded-md">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-10 space-y-10">

        @if (! $profile)
            <div class="bg-white shadow sm:rounded-lg p-8 text-center text-gray-600">
                Portofolio belum diisi. Silakan register/login lalu lengkapi profil di dashboard.
            </div>
        @else
            {{-- Tentang --}}
            <section id="tentang" class="bg-white shadow sm:rounded-lg p-8 flex flex-col sm:flex-row gap-6 items-center">
                @if ($profile->photo)
                    <img src="{{ asset('storage/'.$profile->photo) }}" class="w-32 h-32 rounded-full object-cover" alt="Foto">
                @endif
                <div>
                    <h1 class="text-2xl font-bold">{{ $profile->full_name }}</h1>
                    @if ($profile->headline)
                        <p class="text-gray-600">{{ $profile->headline }}</p>
                    @endif
                    @if ($profile->about)
                        <p class="mt-3">{{ $profile->about }}</p>
                    @endif
                    <div class="mt-3 text-sm text-gray-600 space-y-1">
                        @if ($profile->email) <p>Email: {{ $profile->email }}</p> @endif
                        @if ($profile->phone) <p>Telepon: {{ $profile->phone }}</p> @endif
                        @if ($profile->address) <p>Alamat: {{ $profile->address }}</p> @endif
                    </div>
                </div>
            </section>

            {{-- Pendidikan --}}
            <section id="pendidikan" class="bg-white shadow sm:rounded-lg p-8">
                <h2 class="text-xl font-semibold mb-4">Riwayat Pendidikan</h2>
                @forelse ($educations as $edu)
                    <div class="mb-4 last:mb-0">
                        <p class="font-medium">{{ $edu->institution }}</p>
                        <p class="text-sm text-gray-600">{{ $edu->major }} &middot; {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</p>
                        @if ($edu->description) <p class="text-sm mt-1">{{ $edu->description }}</p> @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada data.</p>
                @endforelse
            </section>

            {{-- Pekerjaan --}}
            <section id="pekerjaan" class="bg-white shadow sm:rounded-lg p-8">
                <h2 class="text-xl font-semibold mb-4">Riwayat Pekerjaan</h2>
                @forelse ($experiences as $exp)
                    <div class="mb-4 last:mb-0">
                        <p class="font-medium">{{ $exp->position }} &middot; {{ $exp->company }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $exp->start_date->format('M Y') }} - {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Sekarang' }}
                        </p>
                        @if ($exp->description) <p class="text-sm mt-1">{{ $exp->description }}</p> @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada data.</p>
                @endforelse
            </section>

            {{-- Portofolio --}}
            <section id="portofolio">
                <h2 class="text-xl font-semibold mb-4">Portofolio</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($portfolios as $p)
                        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                            @if ($p->image)
                                <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-40 object-cover" alt="{{ $p->title }}">
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold">{{ $p->title }}</h3>
                                @if ($p->description) <p class="text-sm text-gray-600 mt-1">{{ $p->description }}</p> @endif
                                @if ($p->url)
                                    <a href="{{ $p->url }}" target="_blank" class="inline-block mt-3 text-sm text-indigo-600 hover:underline">Lihat proyek</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada data.</p>
                    @endforelse
                </div>
            </section>
        @endif
    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        &copy; {{ date('Y') }} {{ $profile->full_name ?? 'Portofolio' }}
    </footer>
</body>
</html>