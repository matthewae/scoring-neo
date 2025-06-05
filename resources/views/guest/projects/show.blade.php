@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Proyek: {{ $project->name }}</h1>
    <p><strong>Deskripsi:</strong> {{ $project->description }}</p>
    <p><strong>Skor Rata-rata:</strong> {{ number_format($project->average_score, 2) }}</p>

    <h2>Dokumen Proyek</h2>
    @if($project->documents->isEmpty())
        <p>Tidak ada dokumen untuk proyek ini.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Dokumen</th>
                    <th>Deskripsi</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->documents as $document)
                    <tr>
                        <td>{{ $document->name }}</td>
                        <td>{{ $document->description }}</td>
                        <td>{{ $document->pivot->value ?? 'Belum Dinilai' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Placeholder untuk grafik -->
    <h2>Grafik Penilaian</h2>
    <div id="assessmentChart" style="width:100%; height:400px;"></div>

    <a href="{{ route('guest.projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
</div>

@push('scripts')
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
@endpush
@endsection