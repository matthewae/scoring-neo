@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajukan Penilaian untuk Proyek: {{ $project->name }}</h1>

    <form action="{{ route('guest.projects.saveAssessment', $project->id) }}" method="POST">
        @csrf
        @foreach($project->documents as $document)
            <div class="form-group">
                <label for="document_{{ $document->id }}">{{ $document->name }} ({{ $document->description }})</label>
                <input type="number" name="documents[{{ $document->id }}]" id="document_{{ $document->id }}" class="form-control" min="0" max="100" value="{{ $document->pivot->value ?? '' }}" required>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Kirim Penilaian</button>
        <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection