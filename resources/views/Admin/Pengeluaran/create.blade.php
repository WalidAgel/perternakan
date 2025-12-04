@extends('Layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-semibold mb-4">Tambah Pengeluaran</h1>

    <div class="bg-white shadow-md rounded-lg p-4">
        <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
            @include('Admin.Pengeluaran.form')
        </form>
    </div>
</div>
@endsection
