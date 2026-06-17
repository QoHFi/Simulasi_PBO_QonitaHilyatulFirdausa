<?php
// PendaftaranKedinasan.php
require_once '2_Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    // Properti tambahan spesifik
    private $skIkatanDinas;
    private $instansiSponsor;

    // Constructor kelas anak yang memanggil constructor induk
    public function __construct($id, $nama, $asalSekolah, $nilai, $biayaDasar, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id, $nama, $asalSekolah, $nilai, $biayaDasar);
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

   // Mengimplementasikan method abstrak dengan polimorfisme overriding
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar * 1.25;
    }

    // Mengimplementasikan method abstrak dari induk
    public function tampilkanInfoJalur() {
        return "Jalur Pendaftaran: Kedinasan | Instansi: " . $this->instansiSponsor . " | No SK: " . $this->skIkatanDinas;
    }

    // Method spesifik untuk mengambil data Kedinasan dari database
    public function getDaftarKedinasan($db) {
        try {
            $query = "SELECT ID_Pendaftaran, Nama_Calon, Nilai_Ujian, Biaya_Pendaftaran_Dasar, SK_Ikatan_Dinas, Instansi_Sponsor
                      FROM Tabel_Pendaftaran
                      WHERE Jalur_Pendaftaran = 'Kedinasan'";

            $stmt = $db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Gagal mengambil data Kedinasan: " . $e->getMessage());
        }
    }
}
?>
