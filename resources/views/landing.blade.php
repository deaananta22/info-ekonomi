@extends('layouts.layout')

@section('title', 'Selamat Datang')

@section('content')
<hr class="my-5" style="border-color: rgba(21, 17, 243, 0.91);">


<div class="text-center mb-4">
    <h2 class="text-white fw-bold"> DINAS DI BAWAH NAUNGAN BAPPEDA PROVINSI</h2>
    <p class="text-light">Berikut adalah anggota tim yang siap mendukung Anda.</p>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    @for ($i = 1; $i <= 9; $i++)
        <div class="col">
            <div class="card bg-dark text-white h-100 shadow-sm border-0" style="border-radius: 16px;">
                <img src="{{ asset('img/foto'.$i.'.jpg') }}" class="card-img-top" alt="Foto {{ $i }}" style="height: 200px; object-fit: cover; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <div class="card-body text-center">
                    <h5 class="card-title">Nama Anggota {{ $i }}</h5>
                    
                </div>
            </div>
        </div>
    @endfor
</div>



@endsection
