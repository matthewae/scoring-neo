@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Proyek Baru</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
        </div>
        <div class="form-group mb-3">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        <div class="form-group mb-3">
            <label for="kementerian_lembaga_perangkat_daerah_institusi">Kementerian/Lembaga/Perangkat Daerah/Institusi</label>
            <input type="text" class="form-control" id="kementerian_lembaga_perangkat_daerah_institusi" name="kementerian_lembaga_perangkat_daerah_institusi" required>
        </div>
        <div class="form-group mb-3">
            <label for="konsultan_perencana">Konsultan Perencana</label>
            <input type="text" class="form-control" id="konsultan_perencana" name="konsultan_perencana" required>
        </div>
        <div class="form-group mb-3">
            <label for="konsultan_mk">Konsultan MK</label>
            <input type="text" class="form-control" id="konsultan_mk" name="konsultan_mk" required>
        </div>
        <div class="form-group mb-3">
            <label for="kontraktor_pelaksana">Kontraktor Pelaksana</label>
            <input type="text" class="form-control" id="kontraktor_pelaksana" name="kontraktor_pelaksana" required>
        </div>
        <div class="form-group mb-3">
            <label for="metode_pemilihan">Metode Pemilihan</label>
            <input type="text" class="form-control" id="metode_pemilihan" name="metode_pemilihan" required>
        </div>
        <div class="form-group mb-3">
            <label for="nilai_kontrak">Nilai Kontrak</label>
            <input type="number" class="form-control" id="nilai_kontrak" name="nilai_kontrak" required>
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_spmk">Tanggal SPMK</label>
            <input type="date" class="form-control" id="tanggal_spmk" name="tanggal_spmk" required>
        </div>
        <div class="form-group mb-3">
            <label for="jangka_waktu">Jangka Waktu (hari)</label>
            <input type="number" class="form-control" id="jangka_waktu" name="jangka_waktu" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Proyek</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection