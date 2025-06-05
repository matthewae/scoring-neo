@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Proyek</h1>
    @if($projects->isEmpty())
        <p>Belum ada proyek yang tersedia.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            <a href="{{ route('guest.projects.assess', $project->id) }}" class="btn btn-primary btn-sm">Ajukan Penilaian</a>
                            <a href="{{ route('guest.projects.upload', $project->id) }}" class="btn btn-secondary btn-sm">Unggah File</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection