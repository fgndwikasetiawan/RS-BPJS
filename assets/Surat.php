<?php
	require('fpdf.php');
	class Surat extends FPDF {
		private $pdf = null;
		private $fields_value = array();
		public function __construct() {
			parent::__construct('L', 'mm', array(120, 70));
			$this->SetMargins(0, 0);
			$this->SetAutoPageBreak(false);
		}
		public function cetak() {
			$this->AddPage();
			$this->header_surat();
			$fields = array(
				'No. SEP' => '123091238',
				'Tgl. SEP' => date('d/m/Y'),
				'No. Kartu' => '19283718733',
				'Peserta' => '1',
				'Nama Peserta' => 'Dwika Setiawan',
				'Tgl. Lahir' => '14/07/1994',
				'Jenis Kelamin' => 'L',
				'Jenis Rawat' => 'Rawat Jalan Di Tempat',
				'Poli Tujuan' => 'Politeknik',
				'Kelas Rawat' => 'V SD',
				'Asal Faskes' => 'Puskesmas',
				'Diagnosa Awal' => 'Kurap Kronis',
				'Catatan' => 'JKM'
			); 
			$this->set_nilai($fields);
			$this->SetFont('Arial', '', 6);
			
			//No. SEP
			$this->Cell(5);
			$this->Cell(20, 3, 'No. SEP');
			$this->Cell(0, 3, ': ' . $this->fields_value['No. SEP'], 0, 1);
			
			//Tgl. SEP
			$this->Cell(5);
			$this->Cell(20, 3, 'Tgl. SEP');
			$this->Cell(0, 3, ': ' . $this->fields_value['Tgl. SEP'], 0, 1);
			
			//No. Kartu
			$this->Cell(5);
			$this->Cell(20, 3, 'No. Kartu');
			$this->Cell(50, 3, ': ' . $this->fields_value['No. Kartu'], 0, 0);
			
			//No. Kartu
			$this->Cell(20, 3, 'Peserta');
			$this->Cell(0, 3, ': ' . $this->fields_value['Peserta'], 0, 1);
			
			//Nama Peserta
			$this->Cell(5);
			$this->Cell(20, 3, 'Nama Peserta');
			$this->Cell(0, 3, ': ' . $this->fields_value['Nama Peserta'], 0, 1);
			
			//Tgl. Lahir
			$this->Cell(5);
			$this->Cell(20, 3, 'Tgl. Lahir');
			$this->Cell(0, 3, ': ' . $this->fields_value['Tgl. Lahir'], 0, 1);
			
			//COB
			
			//Jenis Kelamin
			$this->Cell(5);
			$this->Cell(20, 3, 'Jenis Kelamin');
			$this->Cell(50, 3, ': ' . $this->fields_value['Jenis Kelamin'], 0, 0);
			
			//Jenis Rawat
			$this->Cell(20, 3, 'Jenis Rawat');
			$this->Cell(0, 3, ': ' . $this->fields_value['Jenis Rawat'], 0, 1);
				
			//Poli Tujuan
			$this->Cell(5);
			$this->Cell(20, 3, 'Poli Tujuan');
			$this->Cell(50, 3, ': ' . $this->fields_value['Poli Tujuan'], 0, 0);
			
			//Jenis Rawat
			$this->Cell(20, 3, 'Kelas Rawat');
			$this->Cell(0, 3, ': ' . $this->fields_value['Kelas Rawat'], 0, 1);
			
			//Asal Faskes
			$this->Cell(5);
			$this->Cell(20, 3, 'Asal Faskes Tk. I');
			$this->Cell(0, 3, ': ' . $this->fields_value['Asal Faskes'], 0, 1);
			
			//Diagnosa Awal
			$this->Cell(5);
			$this->Cell(20, 3, 'Diagnosa Awal');
			$this->Cell(0, 3, ': ' . $this->fields_value['Diagnosa Awal'], 0, 1);
			
			//Catatan
			$this->Cell(5);
			$this->Cell(20, 3, 'Catatan');
			$this->Cell(0, 3, ': ' . $this->fields_value['Catatan'], 0, 1);
			
			$this->Cell(0, 4, ' ', 0, 1);

			$this->Cell(5);
			$this->Cell(30, 3, 'Pasien / Keluarga Pasien', 0, 0, 'C');
			$this->Cell(50);
			$this->Cell(30, 3, 'Petugas', 0, 1, 'C');
			
			$this->Cell(0, 10, ' ', 0, 1);
			$this->Cell(5);
			$this->Cell(30, 3, '(____________________)', 0, 0, 'C');
			$this->Cell(50);
			$this->Cell(30, 3, '(____________________)', 0, 1, 'C');
			
			
			
			
			
			$this->Output();
		}
		public function set_nilai($array) {
			$this->fields_value = $array;
		}
		private function header_surat() {
			$this->Image('C:/Users/Wik/xampp/htdocs/RS-BPJS/assets/images/logobpjs.png',0,0, 20);
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(0, 3, '', 0, 2);
			$this->Cell(20);
			$this->Cell(80, 4, 'Surat Eligibilitas Peserta', 0, 2, 'C');
			$this->SetFont('Arial', '', 8);
			$this->Cell(80, 4, 'RSUP Mohammad Hoesin Palembang', 0, 1, 'C');
			$this->Cell(0, 6, ' ', 0, 1);
			$this->Line(0, 13, 120, 13);
		}
		
		
		
	}
		
?>