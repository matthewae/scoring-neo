<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Proyek Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --header-bg-start: #4a00e0;
            --header-bg-end: #8e2de2;
            --card-bg: #ffffff;
            --text-color: #333;
            --card-title-color: #34495e;
            --card-icon-color: #3498db;
            --button-success-start: #2ecc71;
            --button-success-end: #27ae60;
            --button-secondary-start: #95a5a6;
            --button-secondary-end: #7f8c8d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #b2f0d0; /* Solid light green background */
            image.png            display: flex;
            /* Removed justify-content and align-items to allow sidebar positioning */
            min-height: 100vh;
            color: var(--text-color);
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: linear-gradient(to bottom, #28a745, #218838); /* Darker green gradient for sidebar */
            color: #fff;
            transition: all 0.3s;
            padding: 20px;
            box-shadow: 3px 0 10px rgba(0,0,0,0.2);
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #fff;
            text-align: center;
        }

        #sidebar .sidebar-header h3 {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: rgba(255,255,255,0.3);
        }

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .container {
            max-width: 1000px; /* Increased max-width for a wider form */
            width: 100%;
            padding: 30px;
            margin: 0 auto; /* Center the container within the content area */
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 35px;
            margin-bottom: 35px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .card-title {
            font-size: 2.2rem;
            margin-bottom: 30px;
            color: #2c3e50; /* Darker color for the title */
            text-align: left; /* Align title to left */
            font-weight: bold;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #3498db; /* Blue border on focus */
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .btn-success {
            background: linear-gradient(to right, #2ecc71, #27ae60); /* Green gradient for success */
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(to right, #27ae60, #2ecc71);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(to right, #95a5a6, #7f8c8d); /* Grey gradient for secondary */
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(to right, #7f8c8d, #95a5a6);
            color: white;
        }

        .btn-back {
            background: none;
            border: none;
            color: #555; /* Darker color for back button to match image */
            font-size: 1.1rem;
            padding: 0;
            transition: color 0.3s ease;
        }

        .btn-back:hover {
            color: #333;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-row .form-group.full-width {
            flex: none;
            width: 100%;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .checklist-section {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .checklist-section h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .form-navigation .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-navigation .btn-prev {
            background-color: #2ecc71;
            color: white;
            border: none;
        }

        .form-navigation .btn-prev:hover {
            background-color: #27ae60;
        }

        .form-navigation .btn-next {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .form-navigation .btn-next:hover {
            background-color: #2980b9;
        }

        .form-navigation .step-info {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Scoring App</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('projects.index') }}">
                        <i class="fas fa-project-diagram"></i>
                        Project
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-upload"></i>
                        Upload Dokumen
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-file-alt"></i>
                        Pengajuan Penilaian
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-chart-line"></i>
                        Hasil Penilaian
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div class="container">
                <div class="card">
                    <div class="header-row">
                        <div class="card-title">Buat Proyek Baru</div>
                        <a href="{{ route('projects.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>

                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="mb-6 slide glass-effect rounded-xl p-6" id="slide-0">
                            <div class="form-group">
                                <label for="project_name">Nama Proyek</label>
                                <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Masukkan Nama Proyek" required>
                            </div>
                            <div class="form-group">
                                <label for="project_description">Deskripsi Proyek</label>
                                <textarea class="form-control" id="project_description" name="project_description" rows="3" placeholder="Masukkan Deskripsi Proyek" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>

                        @foreach($documentStages as $index => $stage)
                            <div class="mb-6 slide glass-effect rounded-xl p-6" id="slide-{{ $index + 1 }}" style="display: none;">
                                <h4 class="text-md font-medium text-gray-800 mb-3">{{ $stage->name }}</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 document-stage-table" id="document-stage-{{ $stage->id }}">
                                        <thead class="bg-gradient-to-r from-emerald-500/10 to-sky-500/10">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahapan</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uraian Teknis Administrasi</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelengkapan Dokumen</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upload File</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white/50 divide-y divide-gray-200">
                                            @php $no = 1; @endphp
                                            @foreach($stage->documents as $document)
                                                <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $no++ }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stage->name }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $document->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <span id="kelengkapan_{{ $document->id }}" class="px-2 py-1 text-sm rounded-full {{ old('documents.' . $document->id . '.is_complete') === '1' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ old('documents.' . $document->id . '.is_complete') === '1' ? 'Ada' : 'Tidak Ada' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <select name="documents[{{ $document->id }}][is_complete]" onchange="updateKelengkapan('{{ $document->id }}', this.value)" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="">Pilih Status</option>
                                                            <option value="1" {{ old('documents.' . $document->id . '.is_complete') === '1' ? 'selected' : '' }}>Ada</option>
                                                            <option value="0" {{ old('documents.' . $document->id . '.is_complete') === '0' ? 'selected' : '' }}>Tidak Ada</option>
                                                        </select>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="file" name="documents[{{ $document->id }}][file]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png">
                                                        <input type="text" name="documents[{{ $document->id }}][notes]" placeholder="Catatan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-prev" id="prevBtn"><i class="fas fa-chevron-left"></i> Sebelumnya</button>
                        <span class="step-info" id="stepInfo">Tahap 1 dari 8</span>
                        <button type="button" class="btn btn-next" id="nextBtn">Selanjutnya <i class="fas fa-chevron-right"></i></button>
                        <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const documentStages = @json($documentStages);
            let currentSlide = 0;
            const slides = document.querySelectorAll('.slide');
            const navItems = document.querySelectorAll('.nav-item');
            const totalStages = documentStages.length;
            const totalSteps = totalStages + 1; // +1 for the initial project details step
            const stepInfo = document.getElementById('stepInfo');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            function showSlide(n) {
                // Ensure n is within bounds
                if (n >= slides.length) { n = slides.length - 1; }
                if (n < 0) { n = 0; }

                currentSlide = n;

                // Hide all slides first
                slides.forEach(slide => {
                    slide.style.display = 'none';
                });

                // Show the current slide
                slides[currentSlide].style.display = 'block';

                // Update visibility of document tables based on currentSlide
                document.querySelectorAll('.document-stage-table').forEach(table => {
                    table.style.display = 'none'; // Hide all tables first
                });

                // Only try to show a table if currentSlide is not the initial project details step (index 0)
                if (currentSlide > 0) {
                    const activeStageId = documentStages[currentSlide - 1].id; // Adjust index for documentStages array
                    const activeTable = document.getElementById(`document-stage-${activeStageId}`);
                    if (activeTable) {
                        activeTable.style.display = 'table'; // Show only the active stage's table
                    }
                }

                // Update navigation buttons and step info
                updateNavigationButtons();
                updateStepInfo();
            }

            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            function prevSlide() {
                showSlide(currentSlide - 1);
            }

            function updateNavigationButtons() {
                prevBtn.style.display = currentSlide === 0 ? 'none' : 'inline-block';
                nextBtn.style.display = currentSlide === slides.length - 1 ? 'none' : 'inline-block';
                submitBtn.style.display = currentSlide === slides.length - 1 ? 'inline-block' : 'none';
            }

            function updateStepInfo() {
                stepInfo.textContent = `Tahap ${currentSlide + 1} dari ${slides.length}`;
            }

            // Initial display
            showSlide(currentSlide);

            // Event Listeners
            if (prevBtn) {
                prevBtn.addEventListener('click', prevSlide);
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', nextSlide);
            }

            // Function to update kelengkapan status
            window.updateKelengkapan = function(documentId, value) {
                const kelengkapanSpan = document.getElementById(`kelengkapan_${documentId}`);
                if (kelengkapanSpan) {
                    if (value === '1') {
                        kelengkapanSpan.textContent = 'Ada';
                        kelengkapanSpan.classList.remove('bg-red-100', 'text-red-800');
                        kelengkapanSpan.classList.add('bg-green-100', 'text-green-800');
                    } else if (value === '0') {
                        kelengkapanSpan.textContent = 'Tidak Ada';
                        kelengkapanSpan.classList.remove('bg-green-100', 'text-green-800');
                        kelengkapanSpan.classList.add('bg-red-100', 'text-red-800');
                    }
                }
            };
        });
    </script>
</body>
</html>