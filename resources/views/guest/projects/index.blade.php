<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek - Scoring Dokumen Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .table-auto {
            width: 100%;
            border-collapse: collapse;
        }
        .table-auto th, .table-auto td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-auto th {
            background-color: #edf2f7;
            font-weight: 600;
            color: #2d3748;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        .table-auto tbody tr:hover {
            background-color: #f7fafc;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }
        .btn-info {
            background-color: #3182ce;
            color: #ffffff;
        }
        .btn-info:hover {
            background-color: #2c5282;
        }
        .btn-primary {
            background-color: #667eea;
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #5a67d8;
        }
        .btn-secondary {
            background-color: #a0aec0;
            color: #ffffff;
        }
        .btn-secondary:hover {
            background-color: #718096;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Proyek</h1>
            @if($projects->isEmpty())
                <p class="text-gray-600">Belum ada proyek yang tersedia.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-auto">
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
                                    <td class="space-x-2">
                                        <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-info">Lihat Detail</a>
                                        <a href="{{ route('guest.projects.assess', $project->id) }}" class="btn btn-primary">Ajukan Penilaian</a>
                                        <a href="{{ route('guest.projects.upload', $project->id) }}" class="btn btn-secondary">Unggah File</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</body>
</html>