<script src="<?php echo assets_url(); ?>/js/bootstrap-timepicker.min.js"></script>

<script>
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
   });

   $('.timepicker').timepicker({
    showMeridian: false
   });
   function cari_desa(input) {
      id = $(input).val();
      console.log("start ajax desa");
      $.ajax({
         url: '/ajax/daerah_by_id_desa/' + id,
         statusCode: {
            200: function(data) {
               data = JSON.parse(data);
               $('#kelurahan').val(data.NAMA_DESA);
               $('#id_kecamatan').val(data.ID_KECAMATAN);
               $('#kecamatan').val(data.NAMA_KECAMATAN);
            }
         }
      }).always(function(){
         console.log("finish ajax desa");
      });
   }
   function cari_pasien() {
       var tipe = $('#tipe_cari').val();
       var nomor = $('#nomor_cari').val();
       if (tipe == 'medrec') {
         $('#icon_loading').show();
         $.ajax({
             url: '/ajax/data_pasien_by_medrec/' + nomor,
             statusCode: {
                200: function(data) {
                   data = JSON.parse(data);
                   $('#nama').val(data.NAMA);
                   $('#nama_kel').val(data.NAMA_KEL);
                   $('#no_cm').val(data.NO_MEDREC);
                   $('#tempat_lahir').val(data.TMPT_LAHIR);
                   $('#kwn').val(data.WNEGARA);
                   $('#gol_darah').val(data.GOLDARAH);
                   var tanggalSplit = data.TGL_LAHIR.split("-");
                   var tanggal = Number(tanggalSplit[0]);
                   var bulan = Number(tanggalSplit[1]);
                   var tahun = Number(tanggalSplit[2]);
                   $('#tanggal_lahir').val(tanggal);
                   $('#bulan_lahir').val(bulan);
                   $('#tahun_lahir').val(tahun);
                   $('#sex').val(data.SEX);
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
                   $('#icon_loading').hide();
                }
             }
         });
      }
   }
   function hitung_usia(ms) {
      usia = {
         tahun: Math.floor(ms/31556952000),
         bulan: Math.floor((ms % 31556952000)/2629746000)
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
            $('#usia').text('(Usia: ' + usia.tahun + ' tahun, ' + usia.bulan + ' bulan)');
            $('#usia_tahun').val(usia.tahun);
            $('#usia_bulan').val(usia.bulan);
            valid = true;
            $('#tombol_submit').removeAttr('disabled');
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
</script>
