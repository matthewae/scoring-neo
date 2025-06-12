<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proyek</title>
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
        .table th,
        .table td {
            vertical-align: middle;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Proyek: {{ $project->name }}</h1>
        <p><strong>Deskripsi:</strong> {{ $project->description }}</p>
        <p><strong>Skor Rata-rata:</strong> {{ number_format($project->average_score, 2) }}</p>

        <h2>Dokumen Proyek</h2>
        @if($documentsByStage->isEmpty())
            <p>Tidak ada dokumen untuk proyek ini.</p>
        @else
            <ul class="nav nav-tabs" id="documentStageTab" role="tablist">
                @foreach($documentsByStage as $stageName => $documents)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($stageName) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($stageName) }}" type="button" role="tab" aria-controls="{{ Str::slug($stageName) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $stageName }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="documentStageTabContent">
                @foreach($documentsByStage as $stageName => $documents)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($stageName) }}" role="tabpanel" aria-labelledby="{{ Str::slug($stageName) }}-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Deskripsi</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->description }}</td>
                                        <td>{{ $document->pivot->value ?? 'Belum Dinilai' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Placeholder untuk grafik -->
        <h2>Grafik Penilaian</h2>
        <div id="assessmentChart" style="width:100%; height:400px;"></div>

        <a href="{{ route('guest.projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Dokumen', 'Nilai'],
                @foreach($project->documents as $document)
                    ['{{ $document->name }}', {{ $document->pivot->value ?? 0 }}],
                @endforeach
            ]);

            var options = {
                title: 'Penilaian Dokumen Proyek',
                hAxis: {title: 'Dokumen',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0, maxValue: 100}
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('assessmentChart'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>