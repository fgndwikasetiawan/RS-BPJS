<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-4 col-lg-3" id="label_cari">Cari pasien berdasarkan:</div>
               <div class="col-md-2">
                  <select id="tipe_cari" class="form-control">
                     <option value="medrec">No. CM</option>
                     <option value="bpjs">No. BPJS</option>
                  </select>
               </div>
               <div class="col-md-3 col-lg-4">
                  <div class="input-group">
                     <input class="form-control" id="nomor_cari" placeholder="No. CM / No. BPJS">
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="cari_pasien()"><i class="fa fa-search fa-fw" style="height: 20px;"></i></button>
                     </span>
                  </div>
               </div>
               <div class="col-md-1" id="icon_loading">
                  <i class="fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
               </div>
            </div>
         </div>
         <form role="form" class="form-small">
            <div class="panel-body bg-blue-gradient">
               <!--Kolom kiri-->
               <div class="col-md-7" id="kolom_kiri">
                  <div class="row">
                     <div class="col-md-7 form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                     </div>
                     <div class="col-md-5 form-group">
                        <label>Nama Keluarga</label>
                        <input type="text" class="form-control" name="nama_kel" id="nama_kel">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-5 form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                     </div>
                     <div class="col-md-12 col-lg-7 form-group">
                        <label>Tanggal Lahir <span id="usia">&nbsp;</span></label>
                        <div class="row">
                           <div class="col-md-4">
                              <select class="form-control" id="tanggal_lahir" name="tanggal_lahir" onchange="cek_tanggal()">
                              </select>
                           </div>
                           <div class="col-md-4">
                              <select class="form-control" id="bulan_lahir" name="bulan_lahir" onchange="cek_tanggal()">
                              </select>
                           </div>
                           <div class="col-md-4">
                              <select class="form-control" id="tahun_lahir" name="tahun_lahir" onchange="cek_tanggal()">
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="sex" id="sex">
                           <option value="L">Laki-Laki</option>
                           <option value="P">Perempuan</option>
                        </select>
                     </div>
                     <div class="col-md-4 form-group">
                        <label>Gol. Darah</label>
                        <select class="form-control" id="gol_darah" name="gol_darah">
                           <option value="">-</option>
                           <option value="A">A</option>
                           <option value="B">B</option>
                           <option value="AB">AB</option>
                           <option value="O">O</option>
                        </select>
                     </div>
                     <div class="col-md-4 form-group">
                        <label>Agama</label>
                        <select class="form-control" id="agama" name="agama">
                           <?php foreach($agama as $a) { ?>
                           <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Pekerjaan</label>
                        <input class="form-control" name="pekerjaan" id="pekerjaan">
                     </div>
                     <div class="col-md-4 form-group">
                        <label>Pendidikan</label>
                        <select class="form-control" name="pendidikan" id="pendidikan">
                           <?php foreach($pendidikan as $p) { ?>
                           <option value="<?php echo $p; ?>"><?php echo $p; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-4 form-group">
                        <label>Status Kawin</label>
                        <select class="form-control" name="status" id="status">
                           <option value="K">KAWIN</option>
                           <option value="TK">BELUM KAWIN</option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Kewarganegaraan</label>
                        <select class="form-control" name="kwn" id="kwn">
                           <option>WNI</option>
                           <option>WNA</option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-8 form-group">
                        <label>Alamat</label>
                        <input class="form-control" name="alamat" id="alamat">
                     </div>
                     <div class="col-md-4 col-lg-2 form-group">
                        <label>RT</label>
                        <input class="form-control" name="rt" id="rt">
                     </div>
                     <div class="col-md-4 col-lg-2 form-group">
                        <label>RW</label>
                        <input class="form-control" name="rw" id="rw">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Kelurahan</label>
                        <input class="form-control" name="id_desa" id="id_desa" placeholder="ID_DESA" onchange="cari_desa(this)">
                     </div>
                     <div class="col-md-8 form-group">
                        <label>&nbsp;</label>
                        <input class="form-control" name="kelurahan" id="kelurahan" placeholder="KELURAHAN" disabled>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Kecamatan</label>
                        <input class="form-control" name="id_kecamatan" id="id_kecamatan" placeholder="ID_KECAMATAN">
                     </div>
                     <div class="col-md-8 form-group">
                        <label>&nbsp;</label>
                        <input class="form-control" name="kecamatan" id="kecamatan" placeholder="KECAMATAN" disabled>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 form-group">
                        <label>Daerah</label>
                        <input class="form-control" name="id_daerah" id="id_daerah" placeholder="ID_DAERAH">
                     </div>
                     <div class="col-md-8 form-group">
                        <label>&nbsp;</label>
                        <input class="form-control" name="kotakab" id="kotakab" placeholder="KOTAKAB" disabled>
                     </div>
                  </div>
               </div>

               <!--Kolom kanan-->
               <div id="kolom_kanan" class="col-md-5">
                  <div class="row">
                     <div class="col-lg-8 form-group">
                        <label>No. CM</label>
                        <input class="form-control" name="no_cm" id="no_cm">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-4 form-group">
                        <label>Tempat Kartu</label>
                        <input class="form-control" name="tempat_kartu" id="tempat_kartu">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-8 form-group">
                        <label>No. BPJS</label>
                        <input class="form-control" name="no_bpjs" id="no_bpjs">
                     </div>
                  </div>
                  <div class="row" style="text-align: center; margin-top: 30px;">
                     <button class="btn btn-success btn-lg" id="tombol_submit" disabled>Daftar</a>
                  </div>
               </div>
            </div>
            <input type="hidden" id="usia_tahun" name="usia_tahun">
            <input type="hidden" id="usia_bulan" name="usia_bulan">
         </form>
         <div class="panel-footer" id="form_footer">
         </div>
      </div>
   </div>
</div>
