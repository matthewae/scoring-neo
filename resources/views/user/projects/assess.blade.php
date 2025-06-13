<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f7f6; /* Light gray background */
        }
        .content-wrapper {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .container-fluid {
            padding-left: 0; /* Remove left padding for full-width content */
            padding-right: 0; /* Remove right padding for full-width content */
        }
        .stages-column {
            padding-left: 0; /* Remove left padding for the stages column */
        }
        .footer {
            background-color: #343a40; /* Dark footer */
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .navbar {
            background-color: #ffffff !important; /* White navbar */
            border-bottom: 1px solid #e0e0e0;
        }
        .navbar-brand {
            font-weight: bold;
            color: #343a40 !important;
        }
        .nav-link {
            color: #343a40 !important;
        }
        .nav-link:hover {
            color: #007bff !important;
        }
        /* Custom styles for horizontal tabs */
.nav-pills .nav-link {
            font-size: 1.1rem;
            padding: 0.75rem 0.75rem; /* Reduced horizontal padding */
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            text-align: left;
            white-space: normal; /* Allow text to wrap naturally */
            overflow: visible; /* Ensure all text is visible */
            text-overflow: clip; /* Remove ellipsis */
        }
        .nav-pills .nav-link.active {
            background-color: #0056b3; /* Darker blue for active tab background */
            color: #ffffff; /* White text for active tab */
            font-weight: bold;
        }
        .nav-pills .nav-link:hover {
            color: #0056b3;
            background-color: #e9ecef; /* Light gray background on hover */
        }
        .tab-content {
            padding-top: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem; /* Spacing between cards */
        }
        .card-header {
            background-color: #f8f9fa; /* Light background for card header */
            color: #343a40; /* Dark text for card header */
            border-bottom: 1px solid #dee2e6; /* Light border at the bottom */
            padding: 1rem 1.25rem; /* Standard padding */
            font-weight: bold;
        }
        .card-header .nav-pills .nav-link {
            color: #6c757d; /* Default link color */
            font-size: 1.05rem; /* Slightly larger font size */
        }
        .card-header .nav-pills .nav-link.active {
            background-color: #0056b3; /* Darker blue for active tab */
            color: #ffffff; /* White text for active tab */
        }
        .card-header .nav-pills .nav-link:hover {
            background-color: #e9ecef; /* Light gray background on hover */
            color: #0056b3; /* Darker blue on hover */
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary.btn-lg {
            padding: 0.85rem 1.75rem; /* Larger padding for large buttons */
            font-size: 1.15rem; /* Larger font size for large buttons */
        }
        .btn-secondary.btn-lg {
            padding: 0.85rem 1.75rem; /* Larger padding for large buttons */
            font-size: 1.15rem; /* Larger font size for large buttons */
        }
        h1 {
            color: #212529; /* Even darker for main heading */
            font-weight: 700; /* Bolder font weight */
            margin-bottom: 2.5rem; /* Increased margin for main heading */
            font-size: 2.8rem; /* Even larger font size for main heading */
        }
        h2 {
            color: #343a40; /* Darker color for section headings */
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 2rem; /* Larger font size for section headings */
        }
        .form-check-label {
            color: #343a40; /* Darker color for labels */
            font-size: 1.05rem; /* Slightly larger font size */
        }
        .form-group label {
            font-weight: 600; /* Bolder font weight */
            color: #212529; /* Darker color for group labels */
            margin-bottom: 0.5rem;
            font-size: 1.1rem; /* Larger font size for group labels */
        }
        .card-title {
            color: #212529; /* Darker color for card titles */
            font-size: 1.3rem; /* Larger font size for card titles */
            font-weight: 600;
        }
        .card-text {
            font-size: 0.95rem; /* Slightly smaller font for card text */
            color: #6c757d; /* Muted color for description */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid">
<a class="navbar-brand" href="#">
                Scoring Neo
            </a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('user.projects.index') }}">Proyek</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                     </li>
                     <li class="nav-item">
                         <form action="{{ route('logout') }}" method="POST" class="d-inline">
                             @csrf
                             <button type="submit" class="btn btn-link nav-link" style="color: inherit; text-decoration: none;">Logout</button>
                         </form>
                     </li>
                 </ul>
             </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <h1 class="text-center mb-5">{{ $project->name }} - Penilaian Dokumen</h1>

        <form action="{{ route('user.projects.saveAssessment', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-3 stages-column">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
                                @foreach ($documentStages as $index => $stage)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="pills-{{ Str::slug($stage->name) }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ Str::slug($stage->name) }}" type="button" role="tab" aria-controls="pills-{{ Str::slug($stage->name) }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                            {{ $stage->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($documentStages as $index => $stage)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="pills-{{ Str::slug($stage->name) }}" role="tabpanel" aria-labelledby="pills-{{ Str::slug($stage->name) }}-tab">
                                <h2 class="mb-4">{{ $stage->name }}</h2>
                                @foreach ($stage->documents as $document)
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $document->name }}</h5>
                                            <p class="card-text text-muted">{{ $document->description }}</p>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Status Kelengkapan:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="documents[{{ $document->id }}][is_complete]" id="complete_{{ $document->id }}" value="1" {{ (isset($projectDocuments[$document->id]) && $projectDocuments[$document->id]->pivot->is_complete) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="complete_{{ $document->id }}">
                                                        Lengkap (1)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="documents[{{ $document->id }}][is_complete]" id="incomplete_{{ $document->id }}" value="0" {{ (isset($projectDocuments[$document->id]) && !$projectDocuments[$document->id]->pivot->is_complete) ? 'checked' : '' }} {{ !isset($projectDocuments[$document->id]) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="incomplete_{{ $document->id }}">
                                                        Tidak Lengkap (0)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="notes_{{ $document->id }}" class="form-label">Catatan:</label>
                                                <textarea class="form-control" id="notes_{{ $document->id }}" name="documents[{{ $document->id }}][notes]" rows="3">{{ isset($projectDocuments[$document->id]) ? $projectDocuments[$document->id]->pivot->notes : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-5">
                <button type="submit" class="btn btn-primary btn-lg">Simpan Penilaian</button>
                <a href="{{ route('user.projects.index') }}" class="btn btn-secondary btn-lg">Batal</a>
            </div>
        </form>
    </div>

    <footer class="footer mt-auto">
        <div class="container-fluid">
            <p>&copy; {{ date('Y') }} Scoring Neo. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>