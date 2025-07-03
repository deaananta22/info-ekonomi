@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h3>Tambah Rapat Baru</h3>

    <div class="card">
        <div class="card-header bg-primary text-white">Form Tambah Rapat</div>
        <div class="card-body">
            <form method="POST" action="{{ route('rapat.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Waktu</label>
                    <input type="time" name="waktu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('agenda') }}" class="btn btn-secondary">← Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
