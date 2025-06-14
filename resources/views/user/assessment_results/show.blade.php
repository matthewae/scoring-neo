<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg-start: #2c3e50;
            --sidebar-bg-end: #34495e;
            --sidebar-link-hover: rgba(255, 255, 255, 0.1);
            --header-bg-start: #4a00e0;
            --header-bg-end: #8e2de2;
            --card-bg: #ffffff;
            --text-color: #333;
            --card-title-color: #34495e;
            --card-icon-color: #3498db;
            --button-upload-start: #2ecc71;
            --button-upload-end: #27ae60;
            --button-list-start: #95a5a6;
            --button-list-end: #7f8c8d;
            --button-view-all-start: #3498db;
            --button-view-all-end: #2980b9;
            --logout-bg: #e74c3c;
            --logout-hover: #c0392b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #e0f7fa, #e8f5e9);
            display: flex;
            min-height: 100vh;
            color: var(--text-color);
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(to bottom, var(--sidebar-bg-start), var(--sidebar-bg-end));
            color: white;
            padding: 25px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
            position: fixed;
            height: 100%;
            z-index: 1000;
        }

        .sidebar-header {
            text-align: left;
            margin-bottom: 40px;
            font-size: 2rem;
            font-weight: bold;
            color: #ecf0f1;
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar ul.components {
            padding: 0;
            list-style: none;
            flex-grow: 1;
        }

        .sidebar ul.components li {
            margin-bottom: 8px;
        }

        .sidebar ul.components li a {
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            display: block;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .sidebar ul.components li a:hover {
            background: var(--sidebar-link-hover);
            padding-left: 25px;
        }

        .sidebar ul.components li a i {
            margin-right: 12px;
            font-size: 1.3rem;
        }

        .sidebar .logout-button {
            background-color: var(--logout-bg);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-align: left;
            text-decoration: none;
            display: block;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout-button:hover {
            background-color: var(--logout-hover);
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 280px; /* Adjust content to the right of the fixed sidebar */
            width: calc(100% - 280px);
        }

        .navbar {
            background: linear-gradient(to right, var(--header-bg-start), var(--header-bg-end));
            padding: 35px 45px; /* Increased padding */
            border-radius: 15px; /* Slightly more rounded corners */
            margin-bottom: 35px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Enhanced shadow */
        }

        .navbar h1 {
            margin: 0;
            font-size: 2.8rem; /* Larger font size for the main title */
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
        }

        .navbar p {
            margin: 10px 0 0 0;
            font-size: 1.4rem; /* Larger font size for the subtitle */
            opacity: 0.95;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 15px; /* Consistent with navbar */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); /* Consistent with navbar */
            padding: 35px;
            margin-bottom: 35px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--card-title-color);
            display: flex;
            align-items: center;
        }

        .card-title i {
            font-size: 2.5rem;
            margin-right: 20px;
            color: var(--card-icon-color); /* Icon color */
        }

        .card-body p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .btn-custom-upload {
            background: linear-gradient(to right, var(--button-upload-start), var(--button-upload-end));
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .btn-custom-upload:hover {
            background: linear-gradient(to right, var(--button-upload-end), var(--button-upload-start));
            color: white;
        }

        .btn-custom-list {
            background: linear-gradient(to right, var(--button-list-start), var(--button-list-end));
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
        }

        .btn-custom-list:hover {
            background: linear-gradient(to right, var(--button-list-end), var(--button-list-start));
            color: white;
        }

        .btn-custom-view-all {
            background: linear-gradient(to right, var(--button-view-all-start), var(--button-view-all-end));
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
        }

        .btn-custom-view-all:hover {
            background: linear-gradient(to right, var(--button-view-all-end), var(--button-view-all-start));
            color: white;
        }

        .statistic-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            font-size: 1.2rem;
        }

        .statistic-item:last-child {
            border-bottom: none;
        }

        .statistic-item span:first-child {
            font-weight: 500;
            color: #555;
        }

        .statistic-item span:last-child {
            font-weight: bold;
            color: var(--card-icon-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                padding: 15px;
            }

            .sidebar-header {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            .sidebar ul.components li a {
                font-size: 0.9rem;
                text-align: center;
                padding: 10px 5px;
            }

            .sidebar ul.components li a i {
                margin-right: 0;
                display: block;
                margin-bottom: 5px;
            }

            .sidebar ul.components li a span {
                display: none;
            }

            .sidebar .logout-button span {
                display: none;
            }

            .content {
                margin-left: 80px;
                width: calc(100% - 80px);
            }
        }

        .card-header {
            font-weight: bold;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 30%;
        }

        .stage-navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .stage-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 5px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            color: #fff;
        }

        .stage-dot.btn-primary {
            background-color: #007bff;
        }

        .stage-dot.btn-outline-primary {
            background-color: transparent;
            border: 1px solid #007bff;
            color: #007bff;
        }

        .stage-arrow {
            font-size: 1.5rem;
            cursor: pointer;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                Scoring App
            </div>
            <ul class="components">
                <li>
                    <a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ route('user.projects.index') }}">
                        <i class="fas fa-project-diagram"></i> Project
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.documents.upload') }}"><i class="fas fa-upload"></i> <span>Upload Dokumen</span></a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_submissions.index') }}"><i class="fas fa-file-alt"></i> <span>Pengajuan Penilaian</span></a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_results.index') }}"><i class="fas fa-star"></i> <span>Lihat Penilaian</span></a>
                </li>
                <li>
                    <a href="{{ route('user.submission_history.index') }}"><i class="fas fa-history"></i> <span>Riwayat Pengajuan</span></a>
                </li>
            </ul>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </nav>

        <!-- Page Content -->
        <div id="content" class="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <h1>Detail Hasil Penilaian</h1>
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
        <div class="card-header">Grafik Hasil Penilaian</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title text-center">Grafik Total Hasil Penilaian</h5>
                    <div style="width: 600px; margin: auto;">
                        <canvas id="overallAssessmentChart"></canvas>
                    </div>
                </div>
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
                                            <th>Status Persetujuan</th>
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
    // Data dari Laravel
    const allStageData = @json($chartData);
    const overallChartData = @json($overallChartData);

    // Stage IDs untuk navigasi
    const stageIds = @json($stages->pluck('id')->toArray());
    
    let currentStageIndex = 0;
    
    // Overall Assessment Chart
    const overallAssessmentChartCanvas = document.getElementById('overallAssessmentChart');
    const overallAssessmentChart = new Chart(overallAssessmentChartCanvas, {
        type: 'bar',
        data: {
            labels: detailedChartLabels,
            datasets: [{
                label: 'Jumlah Dokumen',
                data: detailedChartValues,
                backgroundColor: detailedChartColors,
                borderColor: detailedChartColors,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Make it a horizontal bar chart
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
                    align: 'end',
                    formatter: (value, context) => {
                        return value;
                    }
                },
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Dokumen'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Dokumen'
                    }
                }
            }
        }
    });

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

        // Update index
        currentStageIndex = stageIds.indexOf(stageId);
    }

    // Fungsi panah navigasi
    function prevStage() {
        if (currentStageIndex > 0) {
            currentStageIndex--;
            showStage(stageIds[currentStageIndex]);
        }
    }

    function nextStage() {
        if (currentStageIndex < stageIds.length - 1) {
            currentStageIndex++;
            showStage(stageIds[currentStageIndex]);
        }
    }

    // Initial display
    if (stageIds.length > 0) {
        showStage(stageIds[0]);
    }
    </script>

</body>
</html>