<?php
/**
 * File: View.php
 * Deskripsi: Berkas View untuk menampilkan Dashboard Penerimaan Mahasiswa Baru Kampus QoHFi.
 * Memisahkan kategori data berdasarkan metode query spesifik & kalkulasi polimorfisme objek.
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
        .card-pink {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.15);
            margin-bottom: 35px;
            background: white;
            overflow: hidden;
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
        <div class="text-center mb-5">
            <h2 class="text-pink-main display-5 font-weight-bold">Daftar Calon Mahasiswa Baru</h2>
            <p class="text-muted">Data diproses secara dinamis melalui pola Single Table Inheritance (STI) & Polimorfisme Berorientasi Objek.</p>
        </div>

        <div class="card card-pink">
            <div class="card-pink-header">📋 Kategori Jalur: REGULER</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Atribut Unik (Informasi Jalur)</th>
                                <th class="text-end" style="width: 20%;">Total Biaya (Kalkulasi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataReguler)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur reguler di database.</td></tr>
                            <?php else:
                                foreach ($dataReguler as $row):
                                    // Pembuatan Instansiasi Objek Polimorfik secara Real-time berdasarkan record database
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

        <div class="card card-pink">
            <div class="card-pink-header">🏆 Kategori Jalur: PRESTASI</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Atribut Unik (Informasi Jalur)</th>
                                <th class="text-end" style="width: 20%;">Total Biaya (Kalkulasi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataPrestasi)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur prestasi di database.</td></tr>
                            <?php else:
                                foreach ($dataPrestasi as $row):
                                    // Pembuatan Instansiasi Objek Polimorfik secara Real-time berdasarkan record database
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

        <div class="card card-pink">
            <div class="card-pink-header">🎖️ Kategori Jalur: KEDINASAN</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-pink m-0 align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">ID Pendaftaran</th>
                                <th style="width: 25%;">Nama Lengkap Calon</th>
                                <th class="text-center" style="width: 10%;">Nilai Ujian</th>
                                <th style="width: 37%;">Atribut Unik (Informasi Jalur)</th>
                                <th class="text-end" style="width: 20%;">Total Biaya (Kalkulasi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dataKedinasan)): ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data pendaftar jalur kedinasan di database.</td></tr>
                            <?php else:
                                foreach ($dataKedinasan as $row):
                                    // Pembuatan Instansiasi Objek Polimorfik secara Real-time berdasarkan record database
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
</body>
</html>
