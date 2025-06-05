@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Unggah File untuk Proyek: {{ $project->name }}</h1>

    <form action="{{ route('guest.projects.uploadFile', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Pilih File</label>
            <input type="file" name="file" id="file" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi File (Opsional)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Unggah File</button>
        <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection