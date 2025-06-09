@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Penilaian Proyek</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Proyek</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assessedProjects as $project)
            <tr>
                <td>{{ $project->project_name }}</td>
                <td>{{ $project->project_description }}</td>
                <td>
                    <a href="{{ route('projects.assessment_results.show', $project->id) }}" class="btn btn-info">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection