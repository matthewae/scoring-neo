@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Guest Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Selamat datang, Guest!</h2>
                    <p>Di sini Anda bisa melihat daftar proyek, skor proyek, dan mengajukan penilaian dokumen.</p>

                    {{-- Links to other guest features --}}
                    <p><a href="{{ route('projects.index') }}">Lihat Daftar Proyek dan Skor</a></p>
                    {{-- Add other links as needed --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection