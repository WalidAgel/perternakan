@extends('Layout.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Edit Karyawan</h1>

<form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST">
    @method('PUT')
    @include('admin.karyawan.form')
</form>
@endsection
