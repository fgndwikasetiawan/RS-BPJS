<?php
	function hitung_umur($tgl, $bulan, $tahun) {
		$sekarang = new DateTime();
		$lahir = new DateTime();
		$lahir->setDate($tahun, $bulan, $tgl);
		$interval = $lahir->diff($sekarang);
		$usia = ['hari' => $interval->d, 'bulan' => $interval->m, 'tahun' => $interval->y];
		return $usia;
	}
?>