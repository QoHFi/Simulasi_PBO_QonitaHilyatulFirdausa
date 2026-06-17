<?php
// PendaftaranReguler.php
require_once '2_Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    // Properti tambahan spesifik
    private $pilihanProdi;
    private $lokasiKampus;

    // Constructor kelas anak yang memanggil constructor induk
    public function __construct($id, $nama, $asalSekolah, $nilai, $biayaDasar, $pilihanProdi, $lokasiKampus) {
        parent::__construct($id, $nama, $asalSekolah, $nilai, $biayaDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

     // Mengimplementasikan method abstrak dengan polimorfisme overriding
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar;
    }

    // Mengimplementasikan method abstrak dari induk
    public function tampilkanInfoJalur() {
        return "Jalur Pendaftaran: Reguler | Prodi: " . $this->pilihanProdi . " | Kampus: " . $this->lokasiKampus;
    }


    // Method spesifik untuk mengambil data Reguler dari database
    public function getDaftarReguler($db) {
        try {
            $query = "SELECT ID_Pendaftaran, Nama_Calon, Nilai_Ujian, Biaya_Pendaftaran_Dasar, Pilihan_Prodi, Lokasi_Kampus
                      FROM Tabel_Pendaftaran
                      WHERE Jalur_Pendaftaran = 'Reguler'";

            $stmt = $db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Gagal mengambil data Reguler: " . $e->getMessage());
        }
    }
}
?>
