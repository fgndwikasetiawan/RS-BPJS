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
      
      if (tipe_cari == 'reg_irj' || tipe_cari == 'ipd' || tipe_cari == 'medrec') {
         if (field_cari.val().length >= 10) {
            field_cari.val(field_cari.val().substr(0, 10));
            cari_pasien();
         }
      }
	}
	
	function generate_sep() {
		var data = {
			no_bpjs: $('#no_bpjs').text(),
			no_sjp: $('#nosjp').val(),
			ppk_rujukan: '', //harus pakai nilai yang mana??
			nm_poli: $('#ruang :selected').val(),
			kelas_pasien: $('#kelas').val(),
			no_cm: $('#no_cm').text() 
		};
		$.ajax({
			url: '<?php echo base_url(); ?>ajax/buat_SEP',
			method: 'POST',
			data: data,
			success: function(res) {
				$('#no_sep').val(res);
				if (($('#tombol_cetak_sep').length > 0) && ($('#no_sep').val() != '')) {
					$('#tombol_cetak_sep').removeAttr('disabled');
				}
			},
			error: function(jqXHR) {
				alert('Error ' + jqXHR.status + ': ' + jqXHR.statusText );
			}
		})
	}
	
	function cetak_sep(event) {
		var tombol = $(event.currentTarget);
		var ipd = tombol.data('ipd');
		window.open('<?php echo base_url(); ?>rawat_inap/cetak_sep/' + ipd, '_blank');
	}
	
	function update_bed(event) {
		var id_ruang = $('#ruang').val();
		var kelas = $('#kelas').val();
		var bed_select = $('#bed');
		bed_select.empty();
		_beds.forEach(function(bed) {
			if (bed.IDRG == id_ruang && bed.KELAS == kelas) {
				bed_select.append('<option>' + bed.BED + '</option>');
			}
		});
	}
	
	function get_no_ipd() {
		$.ajax({
			url: '<?php echo base_url(); ?>ajax/new_no_ipd',
			success: function(data) {
				$('#no_ipd').val(data);
			}  
		})
	}
	
	function cetak_sep() {
		window.open('<?php echo base_url(); ?>rawat_inap/cetak_sep/' + $('#no_ipd').val(), '_blank');
	}
	
	$(function() {
	
		$('.datetimepicker').datetimepicker({
			lang:'id',
			timepicker:false,
			format:'d/m/Y',
			formatDate:'Y/m/d',
			step:5,
			mask:''
		});

		var a = $('#input_no_cm').length;
		if (a == 0) {
			$('#baris_tombol button').attr('disabled', true);
		}
		
		$('#tipe_cari').focus();
		$('#tombol_cetak_sep').click(cetak_sep);	
		$('#tombol_sep').click(generate_sep);
		$('#tombol_cari').click(cari_pasien);
		$('#nomor_cari').on('keyup', caripasien_keyup);
		$('#nomor_cari').on('change', caripasien_change);
		$('#ruang').on('change', update_bed);
		$('#kelas').on('change', update_bed);
		$('#tombol_ipd').click(get_no_ipd);
		if (($('#tombol_cetak_sep').length > 0) && ($('#no_sep').val() != '')) {
			$('#tombol_cetak_sep').removeAttr('disabled');
		}
	});
</script>