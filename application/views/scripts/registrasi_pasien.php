<script>
   function isi_kabupaten() {
     var kabSelect = $('#kabupaten');
     kabSelect.empty();
     kabSelect.append('<option value="9999">(Luar daerah)</option>');
     kabupaten.forEach(function(e, i) {
       kabSelect.append('<option value="' + e[0] + '">' + e[1] + '</option>');
     });
   }
   
   function isi_kecamatan() {
     var idKab = $('#kabupaten').val();
     var kecSelect = $('#kecamatan');
     kecSelect.empty();
     kecSelect.append('<option value="99999">(Luar daerah)</option>');
     kecamatan.forEach(function(e, i) {
       if (e[2] == idKab) {
         kecSelect.append('<option value="' + e[0] + '">' + e[1] + '</option>');
       }
     });
     $('#desa').empty(); 
   }
   
   function isi_desa() {
     var idKec = $('#kecamatan').val();
     var desaSelect = $('#desa');
     desaSelect.empty();
     desaSelect.append('<option value="999999">(Luar daerah)</option>')
     kelurahan.forEach(function(e, i) {
       if (e[2] == idKec) {
         desaSelect.append('<option value="' + e[0] + '">' + e[1] + '</option>');
       }
     });
   }

   function cari_pasien() {
      var tipe = $('#tipe_cari').val();
      var nomor = $('#nomor_cari').val();
      var url = "";
      if (tipe == 'medrec') {
       url = '/ajax/data_pasien_by_medrec/' + nomor;
      }
      else {
       url = '/ajax/data_pasien_by_bpjs/' + nomor
      }
      $('#icon_loading').show();
      $.ajax({
          url: url,
          statusCode: {
             200: function(data) {
                data = JSON.parse(data);
                if (data == null) {
                   $('form')[0].reset();
                   $('#nama').val('TIDAK DITEMUKAN');
                   $('#tombol_submit').attr('disabled', true);
                   $('#usia').text(' ')
                }
                else {
                   $('#nama').val(data.NAMA);
                   $('#nama_kel').val(data.NAMA_KEL);
                   $('#no_cm').val(data.NO_MEDREC);
                   $('#tempat_lahir').val(data.TMPT_LAHIR);
                   $('#kwn').val(data.WNEGARA);
                   $('#gol_darah').val(data.GOLDARAH);
                   if (data.TGL_LAHIR) {
                      var tanggalSplit = data.TGL_LAHIR.split("-");
                      var tanggal = Number(tanggalSplit[0]);
                      var bulan = Number(tanggalSplit[1]);
                      var tahun = Number(tanggalSplit[2]);
                      $('#tanggal_lahir').val(tanggal);
                      $('#bulan_lahir').val(bulan);
                      $('#tahun_lahir').val(tahun);
                      $('#sex').val(data.SEX);
                   }
                   cek_tanggal();
                   $('#agama').val(data.AGAMA);
                   $('#pekerjaan').val(data.PEKERJAAN);
                   $('#pendidikan').val(data.PENDIDIKAN);
                   $('#alamat').val(data.ALAMAT);
                   $('#rt').val(data.RT);
                   $('#rw').val(data.RW);
                   $('#id_desa').val(data.ID_DESA);
                   $('#id_kelurahan').val(data.ID_KELURAHAN);
                   $('#id_kecamatan').val(data.ID_KECAMATAN);
                   $('#id_daerah').val(data.ID_DAERAH);
                   $('#kotakab').val(data.KOTAKAB);
                   $('#tempat_kartu').val(data.TEMPAT_KARTU);
                   $('#no_bpjs').val(data.NO_ASURANSI);
                   $('#status').val(data.STATUS);
                }
                $('#icon_loading').hide();
             }
          }
      });
   }
   function hitung_usia(ms) {
      usia = {
         tahun: Math.floor(ms/31556952000),
         bulan: Math.floor((ms % 31556952000)/2629746000),
         hari: Math.floor((ms % 2629746000)/86400000)
      }
      return usia;
   }
   function cek_tanggal() {
      var tanggal = Number($('#tanggal_lahir').val());
      var bulan = Number($('#bulan_lahir').val());
      var tahun = Number($('#tahun_lahir').val());
      var valid = false;
      var now = new Date();
      if (tanggal > 0 && bulan > 0 && tahun > 0) {
         var date = new Date(tahun, bulan-1, tanggal);
         if (date.getTime() < now.getTime() &&
             date.getDate() == tanggal &&
             date.getMonth() == bulan-1 &&
             date.getFullYear() == tahun
         ) {
            $('#tanggal_lahir').removeClass('invalid-input');
            $('#bulan_lahir').removeClass('invalid-input');
            $('#tahun_lahir').removeClass('invalid-input');
            $('#usia').removeClass('warning-text');
            var usia = hitung_usia(now.getTime() - date.getTime());
            $('#usia').text('(Usia: ' + usia.tahun + ' tahun, ' + usia.bulan + ' bulan, ' + usia.hari + ' hari)');
            $('#usia_tahun').val(usia.tahun);
            $('#usia_bulan').val(usia.bulan);
            $('#usia_hari').val(usia.hari);
            $('#tombol_submit').removeAttr('disabled');
            valid = true;
         }
      }
      if (!valid) {
         $('#tanggal_lahir').addClass('invalid-input');
         $('#bulan_lahir').addClass('invalid-input');
         $('#tahun_lahir').addClass('invalid-input');
         $('#usia').text('(Tanggal tidak valid!)');
         $('#usia').addClass('warning-text');
         $('#tombol_submit').attr('disabled', true);
      }
   }
   
   function reset_form() {
      $('#usia_tahun').val('');
      $('#usia_bulan').val('');
      $('#usia').text('');
      $('#tombol_submit').attr('disabled', true);
   }
   
   function get_no_cm() {
      $.ajax({
         url: '<?php echo base_url(); ?>ajax/new_no_medrec',
         success: function(data) {
            $('#no_cm').val(data);
         }
      });
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
      
      if (tipe_cari == 'medrec') {
         if (field_cari.val().length >= 10) {
            field_cari.val(field_cari.val().substr(0, 10));
            cari_pasien();
         }
      }
   }
   
    $(function() {
      for (i=1; i<=31; i++) {
         $('#tanggal_lahir').append('<option value=' + i + '>' + i + '</option>');
      }
      for (i=1; i<=12; i++) {
         $('#bulan_lahir').append('<option value=' + i + '>' + i + '</option>');
      }
      var year = new Date().getFullYear();
      for (i=year; i>=1900; i--) {
         $('#tahun_lahir').append('<option value=' + i + '>' + i + '</option>');
      }
      isi_kabupaten();
      
      $('#nomor_cari').on('keyup', caripasien_keyup);
      $('#nomor_cari').on('change', caripasien_change);
      $('#tombol_cari').click(cari_pasien);
      $('#tombol_cm').click(get_no_cm);
   });

</script>
