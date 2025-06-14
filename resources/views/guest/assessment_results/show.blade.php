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
                <a href="{{ route('guest.dashboard') }}" class="list-group-item list-group-item-action"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
                <a href="{{ route('guest.projects.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-arrow-up-fill me-2"></i>Pengajuan Dokumen</a>
                <a href="{{ route('guest.assessment_results.index') }}" class="list-group-item list-group-item-action active"><i class="bi bi-star-fill me-2"></i>Lihat Penilaian</a>
                <a href="{{ route('guest.submission_history.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan</a>
                <a href="{{ route('guest.guide') }}" class="list-group-item list-group-item-action"><i class="bi bi-book-fill me-2"></i>Panduan</a>
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
            <p><strong>Nama Proyek:</strong> {{ $project->project_name }}</p>
            <p><strong>Pekerjaan:</strong> {{ $project->pekerjaan }}</p>
            <p><strong>Lokasi:</strong> {{ $project->lokasi }}</p>
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
        <div class="card-header">Grafik Total Hasil Penilaian</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title text-center">Grafik Per Tahap</h5>
                                <div style="width: 400px; margin: auto;">
                                    <canvas id="assessmentChart"></canvas>
                                </div>
                            </div>
                <div class="col-md-6">
                    <h5 class="card-title text-center">Grafik Total Hasil Penilaian</h5>
                    <canvas id="overallAssessmentChart"></canvas>
                </div>
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
                    $stages = \App\Models\DocumentStage::all()->sortBy('id');

                    $chartData = [];
                    $totalCompleteCount = 0;
                    $totalNotCompleteCount = 0;

                    foreach ($stages as $stage) {
                        $completeCount = 0;
                        $notCompleteCount = 0;
                        if ($documentsByStage->has($stage->id)) {
                            foreach ($documentsByStage[$stage->id] as $projectDocument) {
                                if ($projectDocument->is_complete) {
                                    $completeCount++;
                                    $totalCompleteCount++;
                                } else {
                                    $notCompleteCount++;
                                    $totalNotCompleteCount++;
                                }
                            }
                        }
                        $chartData[$stage->id] = [
                            'complete' => $completeCount,
                            'not_complete' => $notCompleteCount,
                            'total' => $completeCount + $notCompleteCount,
                            'percentage_complete' => ($completeCount + $notCompleteCount) > 0 ? round(($completeCount / ($completeCount + $notCompleteCount)) * 100, 2) : 0,
                            'percentage_not_complete' => ($completeCount + $notCompleteCount) > 0 ? round(($notCompleteCount / ($completeCount + $notCompleteCount)) * 100, 2) : 0,
                        ];
                    }

                    $overallChartData = [
                        'complete' => $totalCompleteCount,
                        'not_complete' => $totalNotCompleteCount,
                        'total' => $totalCompleteCount + $totalNotCompleteCount,
                        'percentage_complete' => ($totalCompleteCount + $totalNotCompleteCount) > 0 ? round(($totalCompleteCount / ($totalCompleteCount + $totalNotCompleteCount)) * 100, 2) : 0,
                        'percentage_not_complete' => ($totalCompleteCount + $totalNotCompleteCount) > 0 ? round(($totalNotCompleteCount / ($totalCompleteCount + $totalNotCompleteCount)) * 100, 2) : 0,
                    ];
                @endphp

                @if($documentsByStage->isEmpty())
                    <p>Tidak ada dokumen yang terkait dengan proyek ini.</p>
                @else
                    {{-- Navigasi --}}
                    <div class="d-flex justify-content-center mb-3">
                        <button class="btn btn-outline-secondary me-2" onclick="prevStage()">←</button>
                        @foreach ($stages as $stage)
                            <button class="btn btn-outline-primary stage-dot me-1" data-stage-id="{{ $stage->id }}" onclick="showStage({{ $stage->id }})">
                                {{ $loop->iteration }}
                            </button>
                        @endforeach
                        <button class="btn btn-outline-secondary ms-2" onclick="nextStage()">→</button>
                    </div>

                    {{-- Konten Per Tahap --}}
                    @foreach ($stages as $stage)
                        <div id="stage-{{ $stage->id }}" class="stage-content" style="display: none;">
                            <h5 class="mb-3">Tahap: {{ $stage->name }}</h5>

                            @if ($documentsByStage->has($stage->id) && !$documentsByStage[$stage->id]->isEmpty())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Dokumen</th>
                                            <th>Status</th>
                                            <th style="width: 30%;">Catatan</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documentsByStage[$stage->id] as $projectDocument)
                                            <tr>
                                                <td>{{ $projectDocument->document->name }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($projectDocument->is_complete) bg-success
                                                        @else bg-warning text-dark
                                                        @endif">
                                                        {{ $projectDocument->is_complete ? 'Ada' : 'Tidak Ada' }}
                                                    </span>
                                                </td>
                                                <td>{{ $projectDocument->notes ?? 'Tidak ada catatan' }}</td>
                                                <td>
                                                    @if ($projectDocument->file_path)
                                                        <a href="{{ Storage::url($projectDocument->file_path) }}" target="_blank" class="btn btn-info btn-sm">Lihat File</a>
                                                    @else
                                                        Tidak ada file
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Tidak ada dokumen untuk tahap ini.</p>
                            @endif
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    <a href="{{ route('guest.assessment_results.index') }}" class="btn btn-secondary">Kembali ke Daftar Hasil Penilaian</a>
</div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- Custom JavaScript for sidebar toggle and chart -->

    @php
    $detailedChartLabels = [];
    $detailedChartValues = [];
    $detailedChartColors = [];

    // Skema warna dasar
    $baseColors = [
        '#003f5c', '#58508d', '#bc5090', '#ff6361', '#ffa600',
        '#2ca02c', '#1f77b4', '#ff7f0e', '#d62728', '#9467bd',
        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'
    ];

    $colorIndex = 0;

    foreach ($stages as $stage) {
        $stageId = $stage->id;
        $stageName = $stage->name;
        $complete = $chartData[$stageId]['complete'] ?? 0;
        $notComplete = $chartData[$stageId]['not_complete'] ?? 0;

        // Warna utama dan turunan (Ada vs Tidak Ada)
        $mainColor = $baseColors[$colorIndex % count($baseColors)];
        $notCompleteColor = $baseColors[($colorIndex + 5) % count($baseColors)];

        // Label dan nilai "Ada"
        $detailedChartLabels[] = "$stageName - Ada";
        $detailedChartValues[] = $complete;
        $detailedChartColors[] = $mainColor;

        // Label dan nilai "Tidak Ada"
        $detailedChartLabels[] = "$stageName - Tidak Ada";
        $detailedChartValues[] = $notComplete;
        $detailedChartColors[] = $notCompleteColor;

        $colorIndex++;
    }
@endphp

<script>
    const detailedChartLabels = @json($detailedChartLabels);
    const detailedChartValues = @json($detailedChartValues);
    const detailedChartColors = @json($detailedChartColors);
</script>



    <script>
    // Toggle sidebar
    var sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    }

    // Data dari Laravel
    const allStageData = @json($chartData);
    const overallChartData = @json($overallChartData);

    // Stage IDs untuk navigasi
    // Ambil semua ID tahap dari PHP
    const stageIds = @json($stages->pluck('id')->toArray());
    
    let currentStageIndex = 0;
    
    // Inisialisasi Chart.js - Per Stage
    const assessmentChartCanvas = document.getElementById('assessmentChart');
    const assessmentChart = new Chart(assessmentChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Lengkap', 'Belum Lengkap'],
            datasets: [{
                label: 'Jumlah Dokumen',
                data: [0, 0],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)', // Green for 'Lengkap'
                    'rgba(220, 53, 69, 0.7)'  // Red for 'Belum Lengkap'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Kelengkapan Dokumen per Tahap',
                    font: {
                        size: 16
                    }
                },
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = total > 0 ? ((value / total) * 100).toFixed(1) + '%' : '0%';
                        return value + ' (' + percentage + ')';
                    }
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Dokumen'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Status'
                    }
                }
            }
        }
    });

    // Fungsi update chart sesuai tahap
    function updateChartData(stageId) {
        const dataForStage = allStageData[stageId];
        if (dataForStage) {
            assessmentChart.data.labels = ['Lengkap (' + dataForStage.percentage_complete + '%)', 'Belum Lengkap (' + dataForStage.percentage_not_complete + '%)'];
            assessmentChart.data.datasets[0].data = [dataForStage.complete, dataForStage.not_complete];
        } else {
            // If no data for the stage, assume 0 complete and 0 not complete documents
            assessmentChart.data.datasets[0].data = [0, 0];
        }
        assessmentChart.update();
    }

    // Fungsi tampilkan tahap
    function showStage(stageId) {
        // Sembunyikan semua
        document.querySelectorAll('.stage-content').forEach(div => div.style.display = 'none');
        document.getElementById('stage-' + stageId).style.display = '';

        // Update tombol active
        document.querySelectorAll('.stage-dot').forEach(dot => {
            dot.classList.remove('btn-primary');
            dot.classList.add('btn-outline-primary');
        });
        const activeDot = document.querySelector('.stage-dot[data-stage-id="' + stageId + '"]');
        if (activeDot) {
            activeDot.classList.add('btn-primary');
            activeDot.classList.remove('btn-outline-primary');
        }

        // Update index dan chart
        currentStageIndex = stageIds.indexOf(stageId);
        updateChartData(stageId);
    }

    // Fungsi panah navigasi
    function prevStage() {
        if (currentStageIndex > 0) {
            showStage(stageIds[currentStageIndex - 1]);
        }
    }

    function nextStage() {
        if (currentStageIndex < stageIds.length - 1) {
            showStage(stageIds[currentStageIndex + 1]);
        }
    }

    // Inisialisasi awal
    if (stageIds.length > 0) {
        showStage(stageIds[0]); // Tampilkan tahap pertama
    }

    // Pie Chart - Keseluruhan
    const overallAssessmentChartCanvas = document.getElementById('overallAssessmentChart');
    const overallAssessmentChart = new Chart(overallAssessmentChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Lengkap', 'Belum Lengkap'],
            datasets: [{
                label: 'Persentase Dokumen',
                data: [overallChartData.percentage_complete, overallChartData.percentage_not_complete],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)', // Green for 'Lengkap'
                    'rgba(220, 53, 69, 0.7)'  // Red for 'Belum Lengkap'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Kelengkapan Dokumen Keseluruhan',
                    font: {
                        size: 16
                    }
                },
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    formatter: (value) => value + '%'
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Status'
                    }
                }
            }
        }
    });
</script>

</body>
</html>