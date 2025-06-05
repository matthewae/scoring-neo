@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Selamat datang, User!</h2>
                    <p>Di sini Anda bisa melihat ringkasan proyek, pengajuan penilaian dari guest, dan navigasi ke fitur manajemen proyek.</p>

                    {{-- Placeholder for guest assessment proposals --}}
                    <h3>Pengajuan Penilaian dari Guest</h3>
                    {{-- Table or list to display guest proposals will go here --}}
                    <p>Daftar pengajuan penilaian dari guest akan ditampilkan di sini.</p>

                    {{-- Links to other user features --}}
                    <p><a href="{{ route('projects.index') }}">Lihat Daftar Proyek</a></p>
                    {{-- Add other links as needed --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection