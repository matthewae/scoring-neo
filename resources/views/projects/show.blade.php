@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Proyek: {{ $project->pekerjaan }}</h1>

    <div class="card mb-3">
        <div class="card-header">Informasi Proyek</div>
        <div class="card-body">
            <p><strong>Pekerjaan:</strong> {{ $project->pekerjaan }}</p>
            <p><strong>Lokasi:</strong> {{ $project->lokasi }}</p>
            <p><strong>Kementerian/Lembaga:</strong> {{ $project->kementerian_lembaga_perangkat_daerah_institusi }}</p>
            <p><strong>Konsultan Perencana:</strong> {{ $project->konsultan_perencana }}</p>
            <p><strong>Konsultan MK:</strong> {{ $project->konsultan_mk }}</p>
            <p><strong>Kontraktor Pelaksana:</strong> {{ $project->kontraktor_pelaksana }}</p>
            <p><strong>Metode Pemilihan:</strong> {{ $project->metode_pemilihan }}</p>
            <p><strong>Nilai Kontrak:</strong> {{ number_format($project->nilai_kontrak, 0, ',', '.') }}</p>
            <p><strong>Tanggal SPMK:</strong> {{ $project->tanggal_spmk }}</p>
            <p><strong>Jangka Waktu:</strong> {{ $project->jangka_waktu }} hari</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Penilaian Dokumen</div>
        <div class="card-body">
            {{-- Placeholder for document assessment table/details --}}
            <p>Detail penilaian dokumen untuk proyek ini akan ditampilkan di sini.</p>
            <a href="{{ route('projects.assess', $project->id) }}" class="btn btn-primary">Lakukan Penilaian Dokumen</a>
        </div>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
</div>
@endsection