<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        /* Custom styles for horizontal tabs */
        .nav-pills .nav-link {
            color: #495057; /* Default link color */
            font-weight: normal;
            border-radius: 0;
            padding: 0.75rem 1.25rem;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active {
            background-color: transparent;
            color: #007bff; /* Active tab color */
            font-weight: bold;
            border-bottom-color: #007bff;
        }
        .nav-pills .nav-link:hover {
            color: #007bff;
            border-bottom-color: #a2d2ff; /* Lighter blue on hover */
        }
        .tab-content {
            padding-top: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Penilaian Dokumen</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.projects.index') }}">Proyek</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper py-4">
        <div class="container">
            <h1 class="mb-4">Penilaian Dokumen untuk Proyek: {{ $project->pekerjaan }}</h1>

            <form action="{{ route('projects.saveAssessment', $project->id) }}" method="POST">
                @csrf

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach ($documentStages as $stage)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ Str::slug($stage->name) }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ Str::slug($stage->name) }}" type="button" role="tab" aria-controls="pills-{{ Str::slug($stage->name) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $stage->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach ($documentStages as $stage)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ Str::slug($stage->name) }}" role="tabpanel" aria-labelledby="pills-{{ Str::slug($stage->name) }}-tab">
                            @foreach ($stage->documents as $document)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="document_{{ $document->id }}">{{ $document->name }}</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="documents[{{ $document->id }}][is_complete]" id="document_{{ $document->id }}_complete" value="1" {{ (isset($projectDocuments[$document->id]) && $projectDocuments[$document->id]->is_complete) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="document_{{ $document->id }}_complete">Lengkap (1)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="documents[{{ $document->id }}][is_complete]" id="document_{{ $document->id }}_incomplete" value="0" {{ (isset($projectDocuments[$document->id]) && !$projectDocuments[$document->id]->is_complete) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="document_{{ $document->id }}_incomplete">Tidak Lengkap (0)</label>
                                                </div>
                                            </div>
                                            <textarea name="documents[{{ $document->id }}][notes]" class="form-control mt-2" placeholder="Catatan">{{ $projectDocuments[$document->id]->notes ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mt-4">Simpan Penilaian</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-4">Batal</a>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Scoring Neo. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>