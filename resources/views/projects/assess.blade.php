@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penilaian Dokumen untuk Proyek: {{ $project->pekerjaan }}</h1>

    <form action="{{ route('projects.save_assessment', $project->id) }}" method="POST">
        @csrf
        {{-- Loop through documents and stages to display assessment fields --}}
        @foreach ($documentStages as $stage)
            <h3>{{ $stage->name }}</h3>
            @foreach ($stage->documents as $document)
                <div class="form-group mb-3">
                    <label for="document_{{ $document->id }}">{{ $document->name }}</label>
                    <select name="documents[{{ $document->id }}][is_complete]" id="document_{{ $document->id }}" class="form-control">
                        <option value="1" {{ (isset($projectDocuments[$document->id]) && $projectDocuments[$document->id]->is_complete) ? 'selected' : '' }}>Lengkap (1)</option>
                        <option value="0" {{ (isset($projectDocuments[$document->id]) && !$projectDocuments[$document->id]->is_complete) ? 'selected' : '' }}>Tidak Lengkap (0)</option>
                    </select>
                    <textarea name="documents[{{ $document->id }}][notes]" class="form-control mt-2" placeholder="Catatan">{{ $projectDocuments[$document->id]->notes ?? '' }}</textarea>
                </div>
            @endforeach
        @endforeach

        <button type="submit" class="btn btn-success">Simpan Penilaian</button>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection