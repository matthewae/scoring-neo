<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proyek</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
            background-color: #ffffff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        h1,
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        h1 {
            font-size: 2.2rem;
            font-weight: 600;
        }
        h2 {
            font-size: 1.8rem;
            font-weight: 500;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.7;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table th,
        .table td {
            padding: 12px 15px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            background-color: #e9ecef;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.03);
        }
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.07);
            transition: background-color 0.2s ease-in-out;
        }
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        .nav-tabs .nav-item .nav-link {
            color: #495057;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            margin-bottom: -1px;
            padding: 0.75rem 1.25rem;
        }
        .nav-tabs .nav-item .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
            font-weight: 600;
        }
        .tab-content {
            padding-top: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-bottom-left-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
            background-color: #fff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Proyek: {{ $project->project_name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $project->project_description }}</p>
        <p><strong>Skor Rata-rata:</strong> {{ number_format($project->average_score, 2) }}</p>

        <h2>Dokumen Proyek</h2>
        @if($documentsByStage->isEmpty())
            <p>Tidak ada dokumen untuk proyek ini.</p>
        @else
            <ul class="nav nav-tabs" id="documentStageTab" role="tablist">
                @foreach($documentsByStage as $stageName => $documents)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($stageName) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($stageName) }}" type="button" role="tab" aria-controls="{{ Str::slug($stageName) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $stageName }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="documentStageTabContent">
                @foreach($documentsByStage as $stageName => $documents)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($stageName) }}" role="tabpanel" aria-labelledby="{{ Str::slug($stageName) }}-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Deskripsi</th>
                                    <th>Kelengkapan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->description }}</td>
                                        <td>{{ $document->is_complete ? 'Lengkap' : 'Belum Lengkap' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('guest.projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>