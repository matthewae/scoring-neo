<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan untuk Guest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
        }
        .navbar {
            background-color: #0056b3;
            padding: 1rem 0;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 15px;
        }
        .navbar-nav .nav-link:hover {
            color: #d4edda !important;
        }
        .guide-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0056b3;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
        }
        h2 {
            color: #007bff;
            margin-top: 35px;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }
        p {
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 20px;
        }
        li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }
        li::before {
            content: "\f058"; /* FontAwesome check-circle icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #28a745;
            position: absolute;
            left: 0;
            top: 0;
        }
        .highlight {
            background-color: #e6f7ff;
            padding: 20px;
            border-left: 6px solid #007bff;
            margin-bottom: 30px;
            border-radius: 8px;
            font-style: italic;
            color: #0056b3;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Panduan Guest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-project-diagram"></i> Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-file-upload"></i> Pengajuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-history"></i> Riwayat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container guide-container">
        <h1>Panduan Penggunaan untuk Guest</h1>
        <p class="lead text-center">Selamat datang di halaman panduan! Di sini Anda akan menemukan informasi lengkap tentang cara menggunakan platform ini sebagai guest.</p>

        <div class="highlight">
            <p><strong>Penting:</strong> Sebagai guest, Anda dapat melihat proyek, mengajukan dokumen untuk penilaian, dan melihat riwayat pengajuan Anda.</p>
        </div>

        <h2>1. Melihat Daftar Proyek</h2>
        <p>Untuk melihat daftar proyek yang tersedia:</p>
        <ul>
            <li>Navigasikan ke bagian "Proyek" dari dashboard guest Anda.</li>
            <li>Anda akan melihat daftar semua proyek yang telah dibuat. Klik pada nama proyek untuk melihat detail lebih lanjut.</li>
        </ul>

        <h2>2. Mengajukan Dokumen untuk Penilaian</h2>
        <p>Jika Anda perlu mengajukan dokumen untuk penilaian:</p>
        <ul>
            <li>Pilih proyek yang relevan dari daftar proyek.</li>
            <li>Di halaman detail proyek, Anda akan menemukan daftar dokumen yang terkait dengan proyek tersebut.</li>
            <li>Klik tombol "Ajukan" atau ikon yang sesuai di samping dokumen yang ingin Anda ajukan.</li>
            <li>Anda akan diminta untuk mengunggah file dokumen dan/atau menambahkan catatan. Pastikan file yang diunggah sesuai dengan format yang diminta (misalnya, PDF, DOCX).</li>
            <li>Setelah mengisi semua informasi yang diperlukan, klik "Kirim Pengajuan".</li>
            <li>Pengajuan Anda akan masuk ke antrean untuk ditinjau oleh tim penilai.</li>
        </ul>

        <h2>3. Melihat Riwayat Pengajuan</h2>
        <p>Untuk melacak status pengajuan Anda:</p>
        <ul>
            <li>Akses bagian "Riwayat Pengajuan" dari dashboard guest Anda.</li>
            <li>Di sini Anda dapat melihat semua dokumen yang telah Anda ajukan, statusnya (Menunggu, Disetujui, Ditolak), dan catatan terkait.</li>
            <li>Anda juga dapat melihat file yang telah Anda unggah sebelumnya.</li>
        </ul>

        <h2>4. Melihat Hasil Penilaian</h2>
        <p>Setelah dokumen Anda dinilai:</p>
        <ul>
            <li>Anda dapat melihat hasil penilaian di bagian "Hasil Penilaian" pada dashboard guest.</li>
            <li>Pilih proyek yang relevan untuk melihat skor dan umpan balik untuk setiap dokumen yang telah dinilai.</li>
        </ul>

        <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi administrator sistem.</p>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Nama Perusahaan Anda. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>