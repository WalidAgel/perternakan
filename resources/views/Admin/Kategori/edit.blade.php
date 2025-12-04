@extends('Layout.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @method('PUT')
        @include('kategori-pengeluaran.form')
    </form>
@endsection
