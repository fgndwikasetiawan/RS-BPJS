<script>
	function cari_pasien() {
		var tipe = $('#tipe_cari').val();
		var nomor = $('#nomor_cari').val();
    	window.location = '<?php echo base_url(); ?>pendaftaran/histori_pasien/'+ tipe + '/' + nomor;
   	}
	function generate_sep() {
		var data = {
			no_kartu: $('#no_bpjs').text(),
			ppk_rujukan: $('#ppk_rujukan').val(),
			pelayanan: $('#pelayanan').val(),
			catatan: $('#catatan').val(),
			diagnosa: $('#diagnosa').val(),
			nama_poli: $('#input_nama_poli').val(),
			kelas: $('#kelas').val(),
			no_cm: $('#no_cm').text() 
		};
		$.ajax({
			url: '',
			method: 'POST',
			data: data,
			success: function(res) {
				$('#no_sep').val(res);
			}
		})
	}
   	$(function() {
   		var a = $('#input_no_cm').length;
   		if (a == 0) {
   			$('#baris_tombol button').attr('disabled', true);
   		}

   		$('#tombol_simpan').click(function(e) {
   			e.preventDefault();
   			var form = $('#form');
   			form.attr('action', '<?php echo base_url(); ?>pendaftaran/daftar_ulang');
   			form.submit();
   		});

   		$('#tombol_cetak_SEP').click(function(e) {
   			e.preventDefault();
   			var form = $('#form');
   			form.attr('action', '<?php echo base_url(); ?>pendaftaran/cetak_sep');
   			form.submit();
   		});

   		$('#nm_poli').on('change', function(){
   			var selected = $('#nm_poli option:selected');
   			$('#input_nama_poli').val(selected.text());
   		});
		   
		$('#tombol_sep').click(generate_sep);

   		var selected = $('#nm_poli option:selected');
		$('#input_nama_poli').val(selected.text());	
   	})
</script>