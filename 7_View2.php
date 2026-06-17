<?php
/**
 * File: View.php
 * Deskripsi: Berkas View untuk menampilkan Dashboard Penerimaan Mahasiswa Baru Kampus QoHFi.
 * Memisahkan kategori data berdasarkan metode query spesifik & kalkulasi polimorfisme objek.
 * Ditambahkan fitur interaktif dropdown filter kategori jalur.
 */

require_once '1_Database.php';
require_once '2_Pendaftaran.php';
require_once '3_PendaftaranReguler.php';
require_once '4_PendaftaranPrestasi.php';
require_once '5_PendaftaranKedinasan.php';

// 1. Inisialisasi koneksi database menggunakan PDO dari kelas Database Anda
$database = new Database();
$db = $database->getConnection();

// 2. Instansiasi objek pembantu untuk mengakses metode query spesifik (Tahap 4)
$modelReguler   = new PendaftaranReguler(null, '', '', 0, 0, '', '');
$modelPrestasi  = new PendaftaranPrestasi(null, '', '', 0, 0, '', '');
$modelKedinasan = new PendaftaranKedinasan(null, '', '', 0, 0, '', '');

// 3. Mengambil koleksi data array hasil fetch dari database per kategori
$dataReguler   = $modelReguler->getDaftarReguler($db);
$dataPrestasi  = $modelPrestasi->getDaftarPrestasi($db);
$dataKedinasan = $modelKedinasan->getDaftarKedinasan($db);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PMB Kampus QoHFi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Desain Tema Kustom Bernuansa Pink Elegan & Modern */
        body {
            background-color: #fff5f7;
            color: #4a3b3e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand-qohfi {
            font-weight: bold;
            color: #ffffff !important;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .bg-pink-dark {
            background-color: #ff69b4 !important;
            border-bottom: 4px solid #ff1493;
        }
        .dropdown-pink .btn-dropdown {
            background-color: #d81b60;
            color: white;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(216, 27, 96, 0.2);
        }
        .dropdown-pink .btn-dropdown:hover, .dropdown-pink .btn-dropdown:focus {
            background-color: #c2185b;
            color: white;
        }
        .dropdown-pink .dropdown-menu {
            border: 1px solid #ffb6c1;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .dropdown-pink .dropdown-item:hover {
            background-color: #fff0f5;
            color: #d81b60;
        }
        .card-pink {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.15);
            margin-bottom: 35px;
            background: white;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-pink-header {
            background: linear-gradient(135deg, #ff69b4, #ffb6c1);
            color: white;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 18px;
            border-bottom: 2px solid #ff1493;
        }
        .table-pink th {
            background-color: #ffe4e1 !important;
            color: #d81b60 !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
        }
        .table-pink tbody tr:hover {
            background-color: #fff0f5;
        }
        .badge-pink {
            background-color: #ffb6c1;
            color: #d81b60;
            font-weight: 600;
            border: 1px solid #ff69b4;
            padding: 6px 12px;
            border-radius: 20px;
        }
        .text-pink-main {
            color: #d81b60;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 30px;
            color: #bfa3a8;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-pink-dark shadow">
        <div class="container">
            <a class="navbar-brand navbar-brand-qohfi" href="#">🌸 PMB KAMPUS QoHFi</a>
            <span class="navbar-text text-white d-none d-sm-inline">Sistem Penerimaan Mahasiswa Baru Digital</span>
        </div>
    </nav>

    <div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="text-pink-main display-5 font-weight-bold">Daftar Calon Mahasiswa Baru</h2>
            <p class="text-muted">Simulasi Ujian Akhir Semester Mata Kuliah Pemrogaman Berorientasi Objek Qonita Hilyatul Firdausa.</p>
        </div>

        <div class="d-flex justify-content-center mb-5 dropdown-pink">
            <div class="dropdown">
                <button class="btn btn-dropdown dropdown-toggle shadow-sm" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    🔍 Filter Berdasarkan Jalur: Semua Jalur
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item active" href="#" onclick="filterJalur('semua', 'Semua Jalur', this)">✨ Tampilkan Semua Jalur</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" onclick="filterJalur('reguler', 'Jalur Reguler', this)">📋 Jalur Reguler</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterJalur('prestasi', 'Jalur Prestasi', this)">🏆 Jalur Prestasi</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterJalur('kedinasan', 'Jalur Kedinasan', this)">🎖️ Jalur Kedinasan</a></li>
                </ul>
            </div>
        </div>

        <div class="card card-pink jalur-section" id="section-reguler">
            <div class="card-pink-header">📋 Kategori Jalur: REGULER</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Informasi Jalur</th>
                                <th class="text-end" style="width: 20%;">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataReguler)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur reguler di database.</td></tr>
                            <?php else:
                                foreach ($dataReguler as $row):
                                    $mhs = new PendaftaranReguler(
                                        $row['ID_Pendaftaran'], $row['Nama_Calon'], '-', $row['Nilai_Ujian'],
                                        $row['Biaya_Pendaftaran_Dasar'], $row['Pilihan_Prodi'], $row['Lokasi_Kampus']
                                    );
                            ?>
                                <tr>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $row['ID_Pendaftaran']; ?></span></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row['Nama_Calon']); ?></td>
                                    <td class="text-center fw-bold"><?= number_format($row['Nilai_Ujian'], 2); ?></td>
                                    <td><span class="badge badge-pink"><?= $mhs->tampilkanInfoJalur(); ?></span></td>
                                    <td class="text-end fw-bold text-pink-main">Rp <?= number_format($mhs->hitungTotalBiaya(), 2, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-pink jalur-section" id="section-prestasi">
            <div class="card-pink-header">🏆 Kategori Jalur: PRESTASI</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Informasi Jalur</th>
                                <th class="text-end" style="width: 20%;">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataPrestasi)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur prestasi di database.</td></tr>
                            <?php else:
                                foreach ($dataPrestasi as $row):
                                    $mhs = new PendaftaranPrestasi(
                                        $row['ID_Pendaftaran'], $row['Nama_Calon'], '-', $row['Nilai_Ujian'],
                                        $row['Biaya_Pendaftaran_Dasar'], $row['Jenis_Prestasi'], $row['Tingkat_Prestasi']
                                    );
                            ?>
                                <tr>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $row['ID_Pendaftaran']; ?></span></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row['Nama_Calon']); ?></td>
                                    <td class="text-center fw-bold"><?= number_format($row['Nilai_Ujian'], 2); ?></td>
                                    <td><span class="badge badge-pink"><?= $mhs->tampilkanInfoJalur(); ?></span></td>
                                    <td class="text-end fw-bold text-pink-main">Rp <?= number_format($mhs->hitungTotalBiaya(), 2, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-pink jalur-section" id="section-kedinasan">
            <div class="card-pink-header">🎖️ Kategori Jalur: KEDINASAN</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Informasi Jalur</th>
                                <th class="text-end" style="width: 20%;">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataKedinasan)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur kedinasan di database.</td></tr>
                            <?php else:
                                foreach ($dataKedinasan as $row):
                                    $mhs = new PendaftaranKedinasan(
                                        $row['ID_Pendaftaran'], $row['Nama_Calon'], '-', $row['Nilai_Ujian'],
                                        $row['Biaya_Pendaftaran_Dasar'], $row['SK_Ikatan_Dinas'], $row['Instansi_Sponsor']
                                    );
                            ?>
                                <tr>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $row['ID_Pendaftaran']; ?></span></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row['Nama_Calon']); ?></td>
                                    <td class="text-center fw-bold"><?= number_format($row['Nilai_Ujian'], 2); ?></td>
                                    <td><span class="badge badge-pink"><?= $mhs->tampilkanInfoJalur(); ?></span></td>
                                    <td class="text-end fw-bold text-pink-main">Rp <?= number_format($mhs->hitungTotalBiaya(), 2, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        <p>&copy; 2026 Kampus QoHFi. Seluruh Hak Cipta Dilindungi. Built with Passion & Pink Palette 🌸</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function filterJalur(jalur, labelText, element) {
            // 1. Ubah teks tombol dropdown utama
            document.getElementById('filterDropdown').innerHTML = '🔍 Filter Berdasarkan Jalur: ' + labelText;

            // 2. Atur status class 'active' pada item menu yang diklik
            let items = document.querySelectorAll('.dropdown-item');
            items.forEach(item => item.classList.remove('active'));
            element.classList.add('active');

            // 3. Logika penyembunyian dan penampilan tabel card pendaftaran
            let sections = document.querySelectorAll('.jalur-section');
            sections.forEach(section => {
                if (jalur === 'semua') {
                    section.style.display = 'block'; // Tampilkan semua
                } else {
                    if (section.id === 'section-' + jalur) {
                        section.style.display = 'block'; // Tampilkan yang dicari
                    } else {
                        section.style.display = 'none';  // Sembunyikan yang tidak dipilih
                    }
                }
            });
        }
    </script>
</body>
</html>
