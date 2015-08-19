<script>
	function cari_pasien() {
		var tipe = $('#tipe_cari').val();
		var nomor = $('#nomor_cari').val();
    	window.location = '<?php echo base_url(); ?>pendaftaran/histori_pasien/'+ tipe + '/' + nomor;
   	}
	function generate_sep() {
		var data = {
			no_bpjs: $('#no_bpjs').text(),
			no_sjp: $('#no_sjp').val(),
			ppk_rujukan: $('#ppk_rujukan').val(),
			pelayanan: $('#pelayanan').val(),
			catatan: $('#catatan').val(),
			nm_diagnosa: $('#nm_diagnosa').val(),
			nm_poli: $('#nm_poli').val(),
			kelas_pasien: $('#kelas_pasien').val(),
			no_cm: $('#no_cm').text() 
		};
		$.ajax({
			url: '<?php echo base_url(); ?>ajax/buat_SEP',
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
			form.removeAttr('target');
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
			
			$('.tombol-hapus').click(function(e) {
				var tombol = $(e.target);
				var r = confirm("Apakah anda yakin ingin menghapus entri dengan No. Register " + tombol.data('noreg') + "?");
				if (r) window.location = '<?php echo base_url(); ?>pendaftaran/hapus_entri/' + tombol.data('id') + '/' + tombol.data('noreg');
			})
		   
			$('#tombol_sep').click(generate_sep);
	
	   		var selected = $('#nm_poli option:selected');
			$('#input_nama_poli').val(selected.text());	
   	});
</script>