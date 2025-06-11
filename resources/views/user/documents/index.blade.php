<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokumen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            margin-bottom: 30px;
            text-align: center;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Dokumen</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Dokumen</th>
                    <th>Proyek</th>
                    <th>Status Persetujuan Guest</th>
                    <th>Disetujui Oleh User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projectDocuments as $projectDocument)
                    <tr>
                        <td>{{ $projectDocument->document_name }}</td>
                        <td>{{ $projectDocument->project->project_name }}</td>
                        <td>
                            @if ($projectDocument->guest_approval_status === null)
                                <span class="badge badge-secondary">Pending</span>
                            @elseif ($projectDocument->guest_approval_status === true)
                                <span class="badge badge-success">Disetujui Guest</span>
                            @else
                                <span class="badge badge-danger">Ditolak Guest</span>
                            @endif
                        </td>
                        <td>
                            @if ($projectDocument->approved_by_user === null)
                                <span class="badge badge-secondary">Pending</span>
                            @elseif ($projectDocument->approved_by_user === true)
                                <span class="badge badge-success">Disetujui User</span>
                            @else
                                <span class="badge badge-danger">Ditolak User</span>
                            @endif
                        </td>
                        <td>
                            {{-- Add view/download/edit actions here if needed --}}
                            <a href="#" class="btn btn-sm btn-info">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada dokumen yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection