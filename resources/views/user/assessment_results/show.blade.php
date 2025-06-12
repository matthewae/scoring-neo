<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hasil Penilaian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #wrapper {
            display: flex;
            width: 100%;
            flex-grow: 1;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            transition: all 0.3s ease;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -250px;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 20px 15px;
            font-size: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #fff;
        }
        #sidebar-wrapper .list-group-item {
            background-color: #2c3e50;
            color: #ecf0f1;
            border: none;
            padding: 15px 20px;
            transition: all 0.2s ease;
        }
        #sidebar-wrapper .list-group-item:hover {
            background-color: #34495e;
            color: #fff;
        }
        #sidebar-wrapper .list-group-item.active {
            background-color: #3498db !important;
            color: #fff !important;
            border-radius: 5px;
            margin: 0 10px;
        }
        #page-content-wrapper {
            width: 100%;
            padding: 20px;
            background-color: #f0f2f5;
            flex-grow: 1;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-weight: bold;
            color: #343a40;
            display: flex;
            align-items: center;
        }
        .card-header i {
            margin-right: 10px;
            color: #3498db;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-detail {
            background-color: #1abc9c;
            border-color: #1abc9c;
            color: white;
        }
        .btn-detail:hover {
            background-color: #16a085;
            border-color: #16a085;
            color: white;
        }
        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px;
            }
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
            #page-content-wrapper {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">Scoring System</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
                <a href="{{ route('projects.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-arrow-up-fill me-2"></i>Pengajuan Dokumen</a>
                <a href="{{ route('user.assessment_results.index') }}" class="list-group-item list-group-item-action active"><i class="bi bi-star-fill me-2"></i>Lihat Penilaian</a>
                <a href="{{ route('user.assessment_submissions.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="btn btn-primary" id="sidebarToggle"><i class="bi bi-list"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <!-- Navbar items can go here if needed -->
                    </ul>
                </div>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="container">
    <h1>Detail Hasil Penilaian Proyek: {{ $project->project_name }}</h1>

    <div class="card mb-4">
        <div class="card-header">Informasi Proyek</div>
        <div class="card-body">
            <p><strong>Nama Proyek:</strong> {{ $project->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $project->project_description }}</p>
            <p><strong>Pekerjaan:</strong> {{ $project->pekerjaan }}</p>
            <p><strong>Lokasi:</strong> {{ $project->lokasi }}</p>
            <p><strong>Kementerian/Lembaga/Perangkat Daerah/Institusi:</strong> {{ $project->kementerian_lembaga_perangkat_daerah_institusi }}</p>
            <p><strong>Konsultan Perencana:</strong> {{ $project->konsultan_perencana }}</p>
            <p><strong>Konsultan MK:</strong> {{ $project->konsultan_mk }}</p>
            <p><strong>Kontraktor Pelaksana:</strong> {{ $project->kontraktor_pelaksana }}</p>
            <p><strong>Metode Pemilihan:</strong> {{ $project->metode_pemilihan }}</p>
            <p><strong>Nilai Kontrak:</strong> {{ number_format($project->nilai_kontrak, 2, ',', '.') }}</p>
            <p><strong>Tanggal SPMK:</strong> {{ \Carbon\Carbon::parse($project->tanggal_spmk)->format('d M Y') }}</p>
            <p><strong>Jangka Waktu:</strong> {{ $project->jangka_waktu }} hari</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Dokumen Proyek per Tahap</div>
        <div class="card-body">
            @if ($project->projectDocuments->isEmpty())
                <p>Tidak ada dokumen yang terkait dengan proyek ini.</p>
            @else
                @php
                    $documentsByStage = $project->projectDocuments->groupBy('document.document_stage_id');
                    $stages = \App\Models\DocumentStage::all()->sortBy('id'); // Assuming DocumentStage model exists and has an 'id' for sorting
                @endphp

                @if($documentsByStage->isEmpty())
                    <p>Tidak ada dokumen yang terkait dengan proyek ini.</p>
                @else
                    <div id="documentCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($stages as $stage)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <h5>Tahap: {{ $stage->name }}</h5>
                                    @if ($documentsByStage->has($stage->id) && !$documentsByStage[$stage->id]->isEmpty())
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Dokumen</th>
                                                    <th>Status</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documentsByStage[$stage->id] as $projectDocument)
                                                    <tr>
                                                        <td>{{ $projectDocument->document->document_name }}</td>
                                                        <td>
                                                            @if ($projectDocument->is_completed)
                                                                <span class="badge bg-success">Selesai</span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">Belum Selesai</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $projectDocument->notes ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>Tidak ada dokumen untuk tahap ini.</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#documentCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#documentCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Grafik Hasil Penilaian</div>
        <div class="card-body">
            <canvas id="assessmentChart"></canvas>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Rangkuman Penilaian</div>
        <div class="card-body">
            <p><strong>Total Dokumen:</strong> {{ $totalDocuments }}</p>
            <p><strong>Dokumen Selesai:</strong> {{ $completedDocuments }}</p>
            <p><strong>Dokumen Belum Selesai:</strong> {{ $incompleteDocuments }}</p>
            <p><strong>Persentase Selesai:</strong> {{ number_format($completionPercentage, 2) }}%</p>
        </div>
    </div>

    <a href="{{ route('user.assessment_results.index') }}" class="btn btn-secondary">Kembali ke Daftar Hasil Penilaian</a>
</div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('assessmentChart').getContext('2d');
            var assessmentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Selesai', 'Belum Selesai'],
                    datasets: [{
                        label: 'Jumlah Dokumen',
                        data: [{{ $completedDocuments }}, {{ $incompleteDocuments }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Ringkasan Status Dokumen'
                        }
                    }
                }
            });

            var sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.getElementById('wrapper').classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>