<script>
	$(function(){
		var field_userbaru = $('#userbaru');
		var field_passbaru = $('#passbaru');
		var tombol_simpan = $('#tombol_simpan');
		field_userbaru.val('');
		field_passbaru.val('');
		tombol_simpan.attr('disabled', true);
		
		field_userbaru.change(function(e) {
			if (field_userbaru.val().length > 0 && field_passbaru.val().length > 0) {
				tombol_simpan.removeAttr('disabled');
			}
			else {
				tombol_simpan.attr('disabled', true);
			}
		});
		field_passbaru.change(function(e) {
			if (field_userbaru.val().length > 0 && field_passbaru.val().length > 0) {
				tombol_simpan.removeAttr('disabled');
			}
			else {
				tombol_simpan.attr('disabled', true);
			}
		});
		
		tombol_simpan.click(function(e) {
			e.preventDefault();
			var form = $('#form');
			form.removeAttr('target');
			form.attr('action', '<?php echo base_url(); ?>manajemen/submit');
			form.submit();
		});

		$('.tombol-hapus').click(function(e){
			var tombol = $(e.target);
			var r = confirm("Apakah Anda yakin menghapus user "+ tombol.data('id')+"?");
			if (r) window.location ='<?php echo base_url(); ?>manajemen/hapus/' + tombol.data('id');
		});
	});
</script>