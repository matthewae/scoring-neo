<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Pengajuan Dokumen</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 30px;
            color: #343a40;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        /* Remove vertical tabs styling */
        .vertical-tabs {
            display: block; /* Change display to block */
        }
        .vertical-tabs .nav-pills {
            flex-direction: row; /* Change direction to row for horizontal */
            margin-right: 0; /* Remove margin-right */
            padding-right: 0;
            list-style: none;
            padding-left: 0;
            margin-bottom: 20px; /* Add margin below the navbar */
            border-bottom: 1px solid #dee2e6; /* Add a bottom border */
        }
        .vertical-tabs .nav-pills .nav-item {
            margin-bottom: 0;
            margin-right: 10px; /* Add some space between items */
        }
        .vertical-tabs .nav-pills .nav-link {
            text-align: center; /* Center text for horizontal nav */
            margin-bottom: -1px; /* Adjust margin to align with border */
            border-radius: 0; /* Keep border-radius 0 */
            color: #495057; /* Default link color */
            font-weight: normal;
            padding: 0.5rem 1rem; /* Adjust padding for horizontal nav */
            font-size: 1rem; /* Default font size */
            line-height: 1.5; /* Default line height */
            text-decoration: none;
            border: 1px solid transparent; /* Add transparent border */
            border-bottom-color: transparent; /* Ensure bottom border is transparent by default */
        }
        .vertical-tabs .nav-pills .nav-link.active {
            background-color: transparent; /* No background for active tab */
            color: #000; /* Black color for active tab */
            border-color: #dee2e6 #dee2e6 #fff; /* Add border to active tab */
            border-bottom-color: #fff; /* White bottom border to overlap container border */
            font-weight: bold;
        }
        .vertical-tabs .tab-content {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajukan Pengajuan Dokumen untuk Proyek: {{ $project->name }}</h1>

        <form action="{{ route('guest.projects.saveAssessment', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="vertical-tabs">
                <ul class="nav nav-pills" id="documentStageTab" role="tablist">
                    @foreach($documentStages as $stageId => $stageName)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $stageId }}" data-bs-toggle="pill" data-bs-target="#content-{{ $stageId }}" type="button" role="tab" aria-controls="content-{{ $stageId }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $stageName }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="documentStageTabContent">
                    @foreach($documentStages as $stageId => $stageName)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $stageId }}" role="tabpanel" aria-labelledby="tab-{{ $stageId }}">
                            <div class="mb-4 mt-3">
                                <h2>{{ $stageName }}</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Dokumen</th>
                                                <th>Upload Dokumen</th>
                                                <th>Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($documentsGroupedByStage[$stageId] ?? [] as $document)
                                                <tr>
                                                    <td>{{ $document->name }}</td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <input type="file" name="documents[{{ $document->id }}][file]" id="document_file_{{ $document->id }}" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="documents[{{ $document->id }}][selected]" value="1" id="document_selected_{{ $document->id }}">
                                                            <label class="form-check-label" for="document_selected_{{ $document->id }}">Ajukan</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Tidak ada dokumen untuk tahap ini.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Kirim Pengajuan</button>
            <a href="{{ route('guest.projects.show', $project->id) }}" class="btn btn-secondary mt-4">Batal</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Remove the previous JavaScript for step-by-step navigation
        // as we are now using Bootstrap's tab/pill functionality directly.
        document.addEventListener('DOMContentLoaded', function () {
            var triggerTabList = [].slice.call(document.querySelectorAll('#documentStageTab button'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });
    </script>
</body>
</html>