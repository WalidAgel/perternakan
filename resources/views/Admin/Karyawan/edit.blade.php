@extends('Layout.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    Edit Data Karyawan
                </h1>
                <p class="text-orange-100 mt-1 text-sm">
                    Perbarui informasi karyawan yang sudah terdaftar
                </p>
            </div>

            <a href="{{ route('admin.karyawan.index') }}"
               class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside text-red-700 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <form action="{{ route('admin.karyawan.update', $karyawan->id) }}"
              method="POST"
              class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NAMA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="nama"
                           required
                           value="{{ old('nama', $karyawan->nama) }}"
                           class="w-full px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-orange-500">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           name="email"
                           required
                           value="{{ old('email', $karyawan->email) }}"
                           class="w-full px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-orange-500">
                </div>

                {{-- PASSWORD (OPTIONAL) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password Baru
                        <span class="text-gray-400 text-xs">(Kosongkan jika tidak diubah)</span>
                    </label>

                    <div class="relative">
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Minimal 6 karakter"
                               class="w-full px-4 py-3 pr-12 border rounded-xl
                                      focus:ring-2 focus:ring-orange-500">

                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-4 flex items-center
                                       text-gray-500 hover:text-gray-700">
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12
                                         C3.226 16.338 7.244 19.5 12 19.5
                                         c.993 0 1.953-.138 2.863-.395" />
                            </svg>

                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639
                                         C3.423 7.51 7.36 4.5 12 4.5
                                         c4.638 0 8.573 3.007 9.963 7.178
                                         .07.207.07.431 0 .639" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        No. HP
                    </label>
                    <input type="text"
                           name="no_hp"
                           value="{{ old('no_hp', $karyawan->no_hp) }}"
                           class="w-full px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-orange-500">
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="pt-6 flex gap-3">
                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600
                               text-white font-semibold px-6 py-3 rounded-xl">
                    Update Data
                </button>

                <a href="{{ route('admin.karyawan.index') }}"
                   class="bg-gray-100 hover:bg-gray-200
                          text-gray-700 px-6 py-3 rounded-xl">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

{{-- TOGGLE PASSWORD --}}
<script>
    function togglePassword() {
        const pwd = document.getElementById("password");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        if (pwd.type === "password") {
            pwd.type = "text";
            eyeOpen.classList.remove("hidden");
            eyeClosed.classList.add("hidden");
        } else {
            pwd.type = "password";
            eyeOpen.classList.add("hidden");
            eyeClosed.classList.remove("hidden");
        }
    }
</script>
@endsection
