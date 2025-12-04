@extends('Layout.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Tambah Kategori</h1>

    <form action="{{ route('kategori.store') }}" method="POST">
        @include('kategori-pengeluaran.form')
    </form>
@endsection
