<?php
// PendaftaranPrestasi.php
require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    // Properti tambahan spesifik
    private $jenisPrestasi;
    private $tingkatPrestasi;

    // Constructor kelas anak yang memanggil constructor induk
    public function __construct($id, $nama, $asalSekolah, $nilai, $biayaDasar, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id, $nama, $asalSekolah, $nilai, $biayaDasar);
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    // Mengimplementasikan method abstrak dengan polimorfisme overriding
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar - 50000;
    }

    // Mengimplementasikan method abstrak dari induk
    public function tampilkanInfoJalur() {
    }



    // Method spesifik untuk mengambil data Prestasi dari database
    public function getDaftarPrestasi($db) {
        try {
            $query = "SELECT ID_Pendaftaran, Nama_Calon, Nilai_Ujian, Biaya_Pendaftaran_Dasar, Jenis_Prestasi, Tingkat_Prestasi
                      FROM Tabel_Pendaftaran
                      WHERE Jalur_Pendaftaran = 'Prestasi'";

            $stmt = $db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Gagal mengambil data Prestasi: " . $e->getMessage());
        }
    }
}
?>
