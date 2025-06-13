<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek - Scoring Dokumen Konstruksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }
        #wrapper {
            display: flex;
            width: 100%;
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
        html, body {
            height: 100%;
        }
        #wrapper {
            min-height: 100vh; /* Ensure wrapper takes full viewport height */
        }
        #page-content-wrapper {
            width: 100%;
            padding: 20px;
            background-color: #f0f2f5;
            flex-grow: 1; /* Allow page content to grow and fill available space */
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
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .btn-info {
            background-color: #3182ce;
            border-color: #3182ce;
        }
        .btn-info:hover {
            background-color: #2c5282;
            border-color: #2c5282;
        }
        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
        }
        .btn-primary:hover {
            background-color: #5a67d8;
            border-color: #5a67d8;
        }
        .btn-secondary {
            background-color: #a0aec0;
            border-color: #a0aec0;
        }
        .btn-secondary:hover {
            background-color: #718096;
            border-color: #718096;
        }
        .btn-success {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }
        .btn-success:hover {
            background-color: #27ae60;
            border-color: #27ae60;
        }
        .text-primary {
            color: #3498db !important;
        }
        .text-info {
            color: #1abc9c !important;
        }
        .text-success {
            color: #2ecc71 !important;
        }
        .text-danger {
            color: #e74c3c !important;
        }
        .icon-large {
            font-size: 3rem;
            margin-bottom: 15px;
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
                <a href="{{ route('guest.projects.index') }}" class="list-group-item list-group-item-action active"><i class="bi bi-file-earmark-arrow-up-fill me-2"></i>Pengajuan Dokumen</a>
                <a href="{{ route('guest.assessment_results.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-star-fill me-2"></i>Lihat Penilaian</a>
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

            <div class="container-fluid py-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="bi bi-folder-fill"></i>
                        Daftar Proyek
                    </div>
                    <div class="card-body">
                        @if ($projects->isEmpty())
                            <div class="alert alert-info" role="alert">
                                Belum ada proyek yang tersedia.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Proyek</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td>{{ $project->project_name }}</td>
                                                <td>{{ $project->project_description }}</td>
                                                <td>
                                                    <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                                    <a href="{{ route('guest.projects.assess', $project->id) }}" class="btn btn-primary btn-sm">Ajukan Penilaian</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript for sidebar toggle -->
    <script>
        var sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.getElementById('wrapper').classList.toggle('toggled');
            });
        }
    </script>
</body>
</html>