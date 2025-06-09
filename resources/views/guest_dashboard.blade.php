<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard</title>
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
        #page-content-wrapper {
            width: 100%;
            padding: 20px;
            background-color: #f0f2f5;
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
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .btn-info {
            background-color: #1abc9c;
            border-color: #1abc9c;
        }
        .btn-info:hover {
            background-color: #16a085;
            border-color: #16a085;
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
                <a href="#" class="list-group-item list-group-item-action active"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
                <a href="{{ route('guest.projects.index') }}" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-arrow-up-fill me-2"></i>Pengajuan Dokumen</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-star-fill me-2"></i>Lihat Penilaian</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan</a>
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

                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <i class="bi bi-play-circle-fill"></i>
                                <h5 class="mb-0">Video Tutorial</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="video-container">
                                    <!-- Ganti URL video YouTube Anda di sini -->
                                    <iframe src="https://www.youtube.com/embed/your_video_id" title="Video tutorial" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-book-fill text-success icon-large"></i>
                                <h5 class="card-title">Panduan Penggunaan</h5>
                                <p class="card-text text-muted">Pelajari cara menggunakan sistem scoring dokumen konstruksi.</p>
                                <a href="{{ route('guest.guide') }}" class="btn btn-success mt-auto">Baca Panduan</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-arrow-up-fill text-primary icon-large"></i>
                                <h5 class="card-title">Pengajuan Dokumen</h5>
                                <p class="card-text text-muted">Ajukan dokumen konstruksi Anda untuk dinilai oleh tim ahli kami.</p>
                                <a href="{{ route('guest.projects.index') }}" class="btn btn-primary mt-3">Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-clock-history text-info icon-large"></i>
                                <h5 class="card-title">Riwayat Pengajuan</h5>
                                <p class="card-text text-muted">Pantau status dan riwayat pengajuan dokumen Anda.</p>
                                <a href="#" class="btn btn-info mt-3">Lihat Riwayat</a>
                            </div>
                        </div>
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