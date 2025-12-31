@if (session('success'))
    <div class="max-w-6xl mx-auto mt-4 px-4">
        <div class="flex items-start gap-3 bg-green-50 border border-green-300
                    text-green-800 px-4 py-3 rounded-xl shadow-sm">
            <span class="text-xl">✅</span>
            <div class="flex-1">
                <p class="font-semibold">Berhasil</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()"
                    class="font-bold text-green-600 hover:text-green-800">
                ×
            </button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="max-w-6xl mx-auto mt-4 px-4">
        <div class="flex items-start gap-3 bg-red-50 border border-red-300
                    text-red-800 px-4 py-3 rounded-xl shadow-sm">
            <span class="text-xl">❌</span>
            <div class="flex-1">
                <p class="font-semibold">Gagal</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()"
                    class="font-bold text-red-600 hover:text-red-800">
                ×
            </button>
        </div>
    </div>
@endif
