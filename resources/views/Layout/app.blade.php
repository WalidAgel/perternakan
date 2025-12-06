<!DOCTYPE html>
<html lang="id">
<head>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#B9997F] flex">

    {{-- SIDEBAR --}}
    @include('Layout.sidebar')

    {{-- KONTEN HALAMAN --}}
    <main class="flex-1 p-1">
        @yield('content')
    </main>

    <script src="https://unpkg.com/feather-icons"></script>
    <script> feather.replace(); </script>

</body>
</html>
