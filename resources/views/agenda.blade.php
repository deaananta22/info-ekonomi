@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Agenda Rapat</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    {{-- Tombol Tambah Jadwal Rapat --}}
    <div class="mb-2 text-end">
        <a href="{{ route('rapat.create') }}" class="btn btn-sm btn-primary">+ Tambah Rapat</a>
    </div>

    {{-- Jadwal Rapat --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Jadwal Rapat Mendatang</div>
        <div class="card-body">
            <ul>
                @forelse ($rapats as $rapat)
                    <li>
                        <strong>{{ $rapat->judul }}</strong><br>
                        Tanggal: {{ $rapat->tanggal }}<br>
                        Waktu: {{ $rapat->waktu }}<br>
                        Lokasi: {{ $rapat->lokasi }}
                    </li>
                    <hr>
                @empty
                    <li class="text-muted">Belum ada jadwal rapat.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Tombol Tambah Notulensi --}}
    <div class="mb-2 text-end">
        <a href="{{ route('notulensi.create') }}" class="btn btn-sm btn-success">+ Tambah Notulensi</a>
    </div>

    {{-- Notulensi Rapat --}}
    <div class="card">
        <div class="card-header bg-success text-white">Notulensi Rapat Sebelumnya</div>
        <div class="card-body">
            <ul>
                @forelse ($notulensis as $note)
                    <li>
                        <strong>{{ $note->judul }}</strong> ({{ $note->tanggal }})<br>
                        Ringkasan: {{ $note->isi }}
                    </li>
                    <hr>
                @empty
                    <li class="text-muted">Belum ada notulensi rapat.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
