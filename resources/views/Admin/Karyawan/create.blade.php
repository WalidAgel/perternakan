@extends('Layout.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Tambah Karyawan</h1>

<form action="{{ route('karyawan.store') }}" method="POST">
    @include('admin.karyawan.form')
</form>
@endsection
