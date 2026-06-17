<?php
// Pendaftaran.php

abstract class Pendaftaran {
    // Properti terenkapsulasi (protected)
    protected $ID_Pendaftaran;
    protected $Nama_Calon;
    protected $Asal_Sekolah;
    protected $Nilai_Ujian;
    protected $biayaPendaftaranDasar;

    // Constructor untuk menginisialisasi properti saat objek anak dibuat
    public function __construct($id, $nama, $asalSekolah, $nilai, $biayaDasar) {
        $this->ID_Pendaftaran = $id;
        $this->Nama_Calon = $nama;
        $this->Asal_Sekolah = $asalSekolah;
        $this->Nilai_Ujian = $nilai;
        $this->biayaPendaftaranDasar = $biayaDasar;
    }

    // Metode Abstrak (tanpa body / {} )
    // Wajib diimplementasikan ulang di dalam kelas anak (subclass)
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>
