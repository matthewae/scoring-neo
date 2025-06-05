@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Persetujuan Pengajuan Guest</h1>

    @if ($guestProposals->isEmpty())
        <p>Tidak ada pengajuan penilaian dari guest yang menunggu persetujuan.</p>
    @else
        <table class="table">
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
                        <td>{{ $proposal->project->pekerjaan }}</td>
                        <td>{{ $proposal->document->name }}</td>
                        <td>{{ $proposal->guest_notes }}</td>
                        <td>
                            @if ($proposal->guest_uploaded_file_path)
                                <a href="{{ Storage::url($proposal->guest_uploaded_file_path) }}" target="_blank">Lihat File</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>{{ $proposal->guest_approval_status ? 'Disetujui' : 'Menunggu' }}</td>
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
    @endif
</div>
@endsection