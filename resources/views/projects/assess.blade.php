<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Dokumen Proyek</title>
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
            margin-bottom: 15px;
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

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: var(--button-view-all-start);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .stage-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            display: none; /* Hide all stages by default */
        }

        .stage-section.active {
            display: block; /* Show active stage */
        }

        .navigation-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .navigation-buttons button {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .navigation-buttons .btn-prev {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .navigation-buttons .btn-next {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .navigation-buttons .btn-submit {
            background-color: #28a745;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="width: 150px; margin-bottom: 20px;">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i> Proyek</a>
                </li>
                <li>
                    <a href="{{ route('user.documents.upload') }}"><i class="fas fa-upload"></i> Upload Dokumen</a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_results.index') }}"><i class="fas fa-clipboard-check"></i> Hasil Penilaian</a>
                </li>
                <li>
                    <a href="{{ route('user.assessment_submissions.index') }}"><i class="fas fa-file-alt"></i> Pengajuan Penilaian</a>
                </li>
                <li>
                    <a href="{{ route('user_profile.edit') }}"><i class="fas fa-user"></i> Profil</a>
                </li>
            </ul>
            <a href="{{ route('logout') }}" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>

        <!-- Page Content -->
        <div id="content" class="content">
            <div class="navbar">
                <h1>Penilaian Dokumen Proyek</h1>
                <p>Lakukan penilaian dokumen untuk proyek Anda.</p>
            </div>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-file-signature"></i> Penilaian Dokumen untuk Proyek: {{ $project->pekerjaan }}</h2>

                        <form id="assessmentForm" action="{{ route('projects.saveAssessment', $project->id) }}" method="POST">
                            @csrf
                            @foreach ($documentStages as $index => $stage)
                                <div class="stage-section" id="stage-{{ $index }}">
                                    <h3>{{ $stage->name }}</h3>
                                    @foreach ($stage->documents as $document)
                                        <div class="form-group mb-3">
                                            <label for="document_{{ $document->id }}">{{ $document->name }}</label>
                                            <select name="documents[{{ $document->id }}][is_complete]" id="document_{{ $document->id }}" class="form-control">
                                                <option value="1" {{ (isset($projectDocuments[$document->id]) && $projectDocuments[$document->id]->is_complete) ? 'selected' : '' }}>Lengkap (1)</option>
                                                <option value="0" {{ (isset($projectDocuments[$document->id]) && !$projectDocuments[$document->id]->is_complete) ? 'selected' : '' }}>Tidak Lengkap (0)</option>
                                            </select>
                                            <textarea name="documents[{{ $document->id }}][notes]" class="form-control mt-2" placeholder="Catatan">{{ $projectDocuments[$document->id]->notes ?? '' }}</textarea>
                                        </div>
                                    @endforeach
                                    <div class="navigation-buttons">
                                        @if ($index > 0)
                                            <button type="button" class="btn-prev">Previous</button>
                                        @else
                                            <div></div> {{-- Placeholder for alignment --}}
                                        @endif

                                        @if ($index < count($documentStages) - 1)
                                            <button type="button" class="btn-next">Next</button>
                                        @else
                                            <button type="submit" class="btn-submit">Simpan Penilaian</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary mt-3">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stageSections = document.querySelectorAll('.stage-section');
            let currentStageIndex = 0;

            function showStage(index) {
                stageSections.forEach((section, i) => {
                    if (i === index) {
                        section.classList.add('active');
                    } else {
                        section.classList.remove('active');
                    }
                });
            }

            // Initial display
            showStage(currentStageIndex);

            document.getElementById('assessmentForm').addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-next')) {
                    currentStageIndex++;
                    showStage(currentStageIndex);
                } else if (event.target.classList.contains('btn-prev')) {
                    currentStageIndex--;
                    showStage(currentStageIndex);
                }
            });
        });
    </script>
</body>
</html>