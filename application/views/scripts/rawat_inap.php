<script src="<?php echo assets_url();?>/js/timepicker.js"></script>
<script src="<?php echo assets_url(); ?>/js/datetimepicker.js" type="text/javascript"></script>
<script>
	
	function cari_pasien() {
		var tipe = $('#tipe_cari').val();
		var nomor = $('#nomor_cari').val();
	 	window.location = '<?php echo base_url(); ?>rawat_inap/form/'+ tipe + '/' + nomor;
	}
	
	function caripasien_keyup(event) {
      if (event.keyCode == 13) {
         cari_pasien();
      }
      else {
         caripasien_change(event);
      }
   }
	
	function caripasien_change(event) {
		var tipe_cari = $('#tipe_cari').val();
      var field_cari = $(event.target);
      
      if (tipe_cari == 'reg_irj' || tipe_cari == 'ipd') {
         if (field_cari.val().length >= 10) {
            field_cari.val(field_cari.val().substr(0, 10));
            cari_pasien();
         }
      }
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
	
	function get_data_ppk(no_ppk) {
		$.ajax({
			url: '<?php echo base_url(); ?>ajax/data_ppk/' + no_ppk,
			success: function(res) {
				var data_ppk = JSON.parse(res);
				if (data_ppk) { 
					$('#nama_ppk').text('PPK: ' + data_ppk.NM_PPK + ' (' + data_ppk.JNS_PPK + ')');
				}
				else {
					$('#nama_ppk').text('PPK tidak ditemukan');
				}
			}
		});
	}
	
	$(function() {


		$('.datetimepicker').datetimepicker({
			lang:'id',
			timepicker:false,
			format:'d/m/Y',
			formatDate:'Y/m/d',
			step:5,
			value:'$currentTime',
			mask:''
		});


		var a = $('#input_no_cm').length;
		if (a == 0) {
			$('#baris_tombol button').attr('disabled', true);
		}

		$('#tombol_simpan').click(function(e) {
			e.preventDefault();
			var form = $('#form');
		form.removeAttr('target');
			form.attr('action', '<?php echo base_url(); ?>rawat_jalan/submit');
			form.submit();
		});

		$('#tombol_cetak_SEP').click(function(e) {
			e.preventDefault();
			var form = $('#form');
			form.attr('action', '<?php echo base_url(); ?>rawat_jalan/cetak_sep');
			form.submit();
		});

		$('#id_poli').on('change', function(){
			var selected = $('#id_poli option:selected');
			$('#nm_poli').val(selected.text());
		});
		
		$('#ppk_rujukan').on('change', function() {
			get_data_ppk($('#ppk_rujukan').val());
		});
		
		$('.tombol-hapus').click(function(e) {
			var tombol = $(e.target);
			var r = confirm("Apakah anda yakin ingin menghapus entri dengan No. Register " + tombol.data('noreg') + "?");
			if (r) window.location = '<?php echo base_url(); ?>rawat_jalan/hapus_entri/' + tombol.data('id') + '/' + tombol.data('noreg');
		})
	   
		$('#tombol_sep').click(generate_sep);

		var selected = $('#id_poli option:selected');
		$('#nm_poli').val(selected.text());	
		$('#tombol_cari').click(cari_pasien);
		$('#nomor_cari').on('keyup', caripasien_keyup);
		$('#nomor_cari').on('change', caripasien_change);
		constructTimepicker();
	});
</script>