@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Hasil Penilaian Proyek: {{ $project->project_name }}</h1>

    <div class="card mb-4">
        <div class="card-header">Informasi Proyek</div>
        <div class="card-body">
            <p><strong>Nama Proyek:</strong> {{ $project->project_name }}</p>
            <p><strong>Deskripsi:</strong> {{ $project->project_description }}</p>
            <p><strong>Pekerjaan:</strong> {{ $project->pekerjaan }}</p>
            <p><strong>Lokasi:</strong> {{ $project->lokasi }}</p>
            <p><strong>Kementerian/Lembaga/Perangkat Daerah/Institusi:</strong> {{ $project->kementerian_lembaga_perangkat_daerah_institusi }}</p>
            <p><strong>Konsultan Perencana:</strong> {{ $project->konsultan_perencana }}</p>
            <p><strong>Konsultan MK:</strong> {{ $project->konsultan_mk }}</p>
            <p><strong>Kontraktor Pelaksana:</strong> {{ $project->kontraktor_pelaksana }}</p>
            <p><strong>Metode Pemilihan:</strong> {{ $project->metode_pemilihan }}</p>
            <p><strong>Nilai Kontrak:</strong> {{ number_format($project->nilai_kontrak, 2, ',', '.') }}</p>
            <p><strong>Tanggal SPMK:</strong> {{ \Carbon\Carbon::parse($project->tanggal_spmk)->format('d M Y') }}</p>
            <p><strong>Jangka Waktu:</strong> {{ $project->jangka_waktu }} hari</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Dokumen Dinilai</div>
        <div class="card-body">
            @if ($projectDocuments->isEmpty())
                <p>Tidak ada dokumen yang dinilai untuk proyek ini.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Dokumen</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectDocuments as $document)
                            <tr>
                                <td>{{ $document->document_name }}</td>
                                <td>{{ $document->pivot->notes ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Placeholder for graphs --}}
    <div class="card mb-4">
        <div class="card-header">Grafik Hasil Penilaian (Placeholder)</div>
        <div class="card-body">
            <p>Grafik akan ditampilkan di sini.</p>
            {{-- You can integrate charting libraries like Chart.js or D3.js here --}}
        </div>
    </div>

    <a href="{{ route('projects.assessment_results.index') }}" class="btn btn-secondary">Kembali ke Daftar Hasil Penilaian</a>
</div>
@endsection