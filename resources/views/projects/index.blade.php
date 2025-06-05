@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Proyek</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Buat Proyek Baru</a>

    @if ($projects->isEmpty())
        <p>Belum ada proyek yang tersedia.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Pekerjaan</th>
                    <th>Lokasi</th>
                    <th>Nilai Kontrak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->pekerjaan }}</td>
                        <td>{{ $project->lokasi }}</td>
                        <td>{{ number_format($project->nilai_kontrak, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            {{-- Tambahkan form delete jika diperlukan --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection