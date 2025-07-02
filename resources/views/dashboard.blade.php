@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Dashboard</h4>
            </div>
            <div class="card-body">
                <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
                <p>Anda berhasil login ke sistem.</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Bergabung pada:</strong> {{ Auth::user()->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection