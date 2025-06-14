<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Pengajuan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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
        .table thead th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f2f2f2;
        }
        .status-badge {
            padding: .35em .65em;
            border-radius: .25rem;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }
        .status-pending {
            color: #6c757d;
            background-color: #e2e6ea;
        }
        .status-approved {
            color: #28a745;
            background-color: #d4edda;
        }
        .status-rejected {
            color: #dc3545;
            background-color: #f8d7da;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
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
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                Scoring App
            </div>
            <ul class="components">
                <li>
                    <a href="{{ route('user.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ route('user.projects.index') }}">
                        <i class="bi bi-folder"></i> <span>Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.documents.upload') }}"><i class="bi bi-upload"></i> <span>Upload Dokumen</span></a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_submissions.index') }}"><i class="bi bi-journal-text"></i> <span>Pengajuan Penilaian</span></a>
                </li>
                <li>
                    <a href="{{ route('guest_approvals.index') }}"><i class="bi bi-person-check"></i> <span>Persetujuan Guest</span></a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_results.index') }}"><i class="bi bi-star-fill"></i> <span>Lihat Penilaian</span></a>
                </li>
            </ul>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-button"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
        </nav>
        <!-- Page Content -->
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="btn btn-primary d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <!-- Navbar items can go here if needed -->
                    </ul>
                </div>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="container-fluid py-4">
                <h2 class="mb-4">Persetujuan Pengajuan Guest</h2>

                @if ($guestProposals->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Tidak ada pengajuan penilaian dari guest yang menunggu persetujuan.
                    </div>
                @else
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <i class="bi bi-table me-2"></i>Daftar Pengajuan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Proyek</th>
                                            <th>Dokumen</th>
                                            <th>Catatan Guest</th>
                                            <th>File Upload Guest</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guestProposals as $proposal)
                                            <tr>
                                                <td>{{ $proposal->project->project_name }}</td>
                                                <td>{{ $proposal->document->name }}</td>
                                                <td>{{ $proposal->guest_notes }}</td>
                                                <td>
                                                    @if ($proposal->guest_uploaded_file_path)
                                                        <a href="{{ Storage::url($proposal->guest_uploaded_file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            Lihat File
                                                        </a>
                                                    @else
                                                        Tidak ada file
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($proposal->guest_approval_status === null)
                                                        <span class="status-badge status-pending">Menunggu</span>
                                                    @elseif ($proposal->guest_approval_status === 1)
                                                        <span class="status-badge status-approved">Disetujui</span>
                                                    @else
                                                        <span class="status-badge status-rejected">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('guest_approvals.approve', $proposal->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                    </form>
                                                    <form action="{{ route('guest_approvals.reject', $proposal->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript for sidebar toggle -->
    <script>
        var sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.querySelector('.wrapper').classList.toggle('toggled');
            });
        }
    </script>
</body>
</html>