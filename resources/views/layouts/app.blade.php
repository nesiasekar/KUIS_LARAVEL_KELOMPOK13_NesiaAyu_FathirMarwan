<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kostan Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F3F6FD]">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col p-6 sticky top-0 h-screen">
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold text-xl">K</div>
                <span class="text-xl font-bold text-gray-800">Kostan</span>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 bg-purple-500 text-white rounded-xl shadow-lg shadow-purple-200 font-medium">
                    <span class="text-lg">🏠</span> Dashboard
                </a>
                <a href="{{ route('kamar.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition font-medium">
                    <span class="text-lg">🛏️</span> Kamar
                </a>
                <a href="{{ route('penyewa.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition font-medium">
                    <span class="text-lg">👥</span> Penyewa
                </a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition font-medium">
                    <span class="text-lg">📊</span> Laporan Pembayaran
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-gray-50">
                <a href="#" class="flex items-center gap-3 p-3 text-gray-500 hover:text-red-500 transition font-medium">
                    <span>🚪</span> Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <div class="flex items-center gap-4 bg-white p-2 pr-6 rounded-full shadow-sm border border-gray-50">
                    <img src="https://ui-avatars.com/api/?name=Pak+Budi&background=random" class="w-10 h-10 rounded-full" alt="Avatar">
                    <div>
                        <p class="text-sm font-bold text-gray-800 leading-none">Pak Budi</p>
                        <p class="text-xs text-gray-400">Admin Owner</p>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>