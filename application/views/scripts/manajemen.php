<script>
	$(function(){
		$('#tombol_simpan').click(function(e) {
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