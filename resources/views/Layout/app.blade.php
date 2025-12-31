<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'DWI FARM')</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="min-h-screen bg-[#B9997F]">
    <div class="flex flex-col md:flex-row min-h-screen">

        {{-- SIDEBAR --}}
        @include('Layout.sidebar')

        {{-- MAIN CONTENT --}}
        <main class="flex-1 w-full md:w-auto overflow-x-hidden pt-16 md:pt-0">
            <div class="p-3 md:p-6 lg:p-8">

                {{-- ALERT (TARUH DI SINI) --}}
                @include('components.alert')

                {{-- ISI HALAMAN --}}
                @yield('content')

            </div>
        </main>

    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    @stack('scripts')
</body>

</html>

<!-- 3. DASHBOARD ADMIN - Mobile Responsive -->
<!-- Tambahkan class responsive pada dashboard cards dan tables -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
    <!-- Cards akan otomatis responsive -->
</div>

<!-- Table wrapper untuk mobile scroll -->
<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[640px]">
            <!-- Table content -->
        </table>
    </div>
</div>

<!-- 4. CSS UTILITIES - Tambahkan ke app.css jika diperlukan -->
<style>
    /* Prevent horizontal scroll */
    body {
        overflow-x: hidden;
    }

    /* Mobile-first responsive utilities */
    @media (max-width: 768px) {

        /* Smaller text on mobile */
        .text-responsive {
            font-size: 0.875rem;
        }

        /* Stack buttons vertically on mobile */
        .btn-group-mobile {
            flex-direction: column;
        }

        /* Full width inputs on mobile */
        input,
        select,
        textarea {
            font-size: 16px;
            /* Prevent zoom on iOS */
        }
    }

    /* Touch-friendly tap targets */
    button,
    a {
        min-height: 44px;
        min-width: 44px;
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>
