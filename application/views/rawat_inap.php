<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-4 col-lg-3" id="label_cari">Cari pasien berdasarkan:</div>
               <div class="col-md-3">
                  <select id="tipe_cari" class="form-control">
                     <option value="medrec">No. CM</option>
                     <option value="bpjs">No. BPJS</option>
                     <option value="register">No. Reg. IRJ</option>
                  </select>
               </div>
               <div class="col-md-4 col-lg-4">
                  <div class="input-group">
                     <input class="form-control" id="nomor_cari" placeholder="No. CM / No. BPJS / No. Reg. IRJ">
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="cari_pasien()"><i class="fa fa-search fa-fw"></i></button>
                     </span>
                  </div>
               </div>
            </div>
         </div>
          <form id="form" role="form" target="_blank" method="post">
            <div class="panel-body bg-blue-gradient">
               <!--Kolom kiri-->               
                <div class="row">
                  <!-- Tabel data pasien -->
                  <div class="col-md-4 col-md-offset-2">
                    <div class="table-responsive">
                      <table class="table center-table">
                         <tbody>
                            <tr>
                              <td class="success col-md-2" ><b>No. CM</b></td>
                              <td class="info col-md-3" id="no_cm"><?php if (isset($no_cm)) echo $no_cm ?></td>
                              <?php if (isset($no_cm)) { ?><input type="hidden" id="input_no_cm" name="no_cm" value="<?php echo $no_cm;?>"> <?php } ?>
                            </tr>
                         </tbody>                         
                         <tbody>
                            <tr>
                              <td class="success col-md-2"><b>Nama</b></td>
                              <td class="info col-md-3" id="nama"><?php if(isset($nama)) echo $nama ?></td>
                              <input type="hidden" name="input_nama" value="<?php if (isset($nama)) echo $nama; ?>">
                            </tr>
                         </tbody>
                         <tbody>
                            <tr>
                              <td class="success col-md-2"><b>Tanggal Lahir</b></td>
                              <td class="info col-md-3" id="tgl_lahir"><?php if (isset($tgl_lahir)) echo $tgl_lahir ?></td>
                              <input type="hidden" name="input_tgl_lahir" value="<?php if (isset($tgl_lahir)) echo $tgl_lahir; ?>">
                            </tr>
                         </tbody>                                                   
                      </table>
                    </div>
                  </div>
                  <!-- Kolom kanan -->
                  <div class="col-md-4">
                     <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td class="success col-md-2"><b>No. BPJS</b></td>
                              <td class="info col-md-3" id="no_bpjs"><?php if (isset($no_bpjs)) echo $no_bpjs ?></td>
                              <input type="hidden" name="input_no_bpjs" value="<?php if (isset($no_bpjs)) echo $no_bpjs; ?>">
                            </tr>
                           </tbody>
                           <tbody>
                            <tr>
                              <td class="success col-md-2"><b>Jenis Kelamin</b></td>
                              <td class="info col-md-3" id="sex"><?php if(isset($sex)) echo $sex ?></td>
                              <input type="hidden" name="input_sex" value="<?php if (isset($sex)) echo $sex; ?>">
                            </tr>
                            </tbody> 
                           <tbody>
                            <tr>
                              <td class="success col-md-2"><b>Usia</b></td>
                              <td class="info col-md-3" id="usia"><?php if (isset($usia)) echo $usia ?></td>
                            </tr>
                           </tbody>                           
                         </table>
                     </div>
                  </div>
                </div>
                <hr>
                <!-- Form -->
                <div class="row">
                   <div class="col-md-5 kolom_kiri">
                     <div class="form-group">
                       <label>No. Register IRJ</label>
                       <input class="form-control" name="noreg_irj" id="noreg_irj" value="<?php if (isset($noreg)) echo $noreg; ?>">
                     </div>
                     <div class="form-group">
                        <label>No. IPD</label>
                        <div class="input-group">
                           <input class="form-control" type="text" id="no_ipd" name="no_ipd">
                           <span class="input-group-btn">
                              <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                           </span>
                        </div>
                     </div>
                     <div class="form-group">
                       <label>No. Register Ibu</label>
                       <input class="form-control" name="no_ipd_ibu" id="no_ipd_ibu" value="<?php if (isset($noreg)) echo $noreg; ?>">
                     </div>   
                     <div class="form-group">
                        <label>Tanggal Daftar <span id="usia">&nbsp;</span></label>
                        <timepicker name="tgl_daftar"></timepicker>                     
                     </div>
                     <div class="form-group">                      
                       <label>Cara Berkunjung</label>
                       <select class="form-control" name="cara_kunj" id="cara_kunj">
                         <?php foreach($kunj as $k) { ?>
                           <option value="<?php echo $k->CARA_KUNJ; ?>"><?php echo $k->CARA_KUNJ; ?></option>
                         <?php } ?>
                       </select>                     
                     </div>
                     <div class="form-group">
                       <label>Cara Bayar</label>
                       <select class="form-control" name="cara_bayar" id="cara_bayar">
                         <?php foreach($bayar as $b) { ?>
                           <option value="<?php echo $b->CARA_BAYAR; ?>"><?php echo $b->CARA_BAYAR; ?></option>
                         <?php } ?>
                       </select>
                     </div>                  
                   </div>
                   <!-- Kolom tengah -->
                   <div class="col-md-offset-1 col-md-5">
                     <div class="form-group">      
                       <label>SMF</label>
                       <select class="form-control" id="smf" name="id_smf">                         
                       </select>                     
                     </div>
                     <div class="form-group">
                       <label>Dokter</label>
                       <select class="form-control" id="dokter" name="id_dokter">                         
                       </select>                     
                     </div> 
                     <div class="form-group">
                       <label>Ruang</label>
                       <select class="form-control" id="ruang" name="id_ruang">                         
                       </select>                     
                     </div>
                     <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <timepicker name="tgl_masuk"></timepicker>
                     </div>
                     <div class="form-group">
                       <label>Kelas</label>
                       <select class="form-control" id="kelas" name="kelas">                         
                       </select>                     
                     </div>
                     <div class="form-group">
                       <label>Bed</label>
                       <select class="form-control" id="bed" name="bed">                         
                       </select>                     
                     </div> 
                   </div>
                </div>
                <hr>
                <!-- Form penjamin -->
                <div class="row">
                   <div class="col-md-5 kolom_kiri">
                     <label>Penjamin</label>
                     <div class="form-group">
                      <label>No.SJP / No. Surat</label>
                      <input class="form-control" id="no_sjp" name="no_sjp">
                     </div>
                     <div class="form-group">
                      <label>Perusahaan</label>
                      <select class="form-control" name="id_perusahaan" id="perusahaan"></select>
                     </div>
                     <div class="form-group">
                      <label>No. Peserta</label>
                      <input class="form-control" name="no_peserta" id="no_peserta">
                     </div>
                     <div class="form-group">
                       <label>No. SEP</label>
                       <div class="input-group">
                           <input type="text" class="form-control" name="no_sep" id="no_sep" readonly>
                           <span class="input-group-btn">
                               <button class="btn btn-success" style="font-size: 12px; line-height: 18px;" type="button" id="tombol_sep"><i class="fa fa-plus"></i></button>
                           </span>
                       </div>
                     </div>
                      <div class="form-group">
                         <label>Nama Peserta</label>
                         <input class="form-control" name="nama_peserta" id="nama_peserta">
                      </div>
                      <div class="form-group">
                         <label>Ket. Pembayar</label>
                         <select class="form-control" name="ket_pembayar" id="ket_pembayar"></select>
                      </div>
                      <div class="form-group">
                         <label>Golongan</label>
                         <input class="form-control" name="golongan" id="golongan">
                      </div>
                      <div class="form-group">
                         <label>Jatah Kelas</label>
                         <input class="form-control" name="jatah_kelas" id="jatah_kelas">
                      </div>
                   </div>
                   <div class="col-md-5 kolom_kiri">
                   </div>
                   <div class="col-md-5 col-md-offset-1">
                      <label>Keluarga</label>
                      <div class="form-group">
                         <label>Nama</label>
                         <input class="form-control" name="nama_pjawab">
                      </div>
                      <div class="form-group">
                         <label>Alamat</label>
                         <input class="form-control" name="alamat_pjawab">
                      </div>
                      <div class="form-group">
                         <label>No.Telp / HP</label>
                         <input class="form-control" name="telp_pjawab">
                      </div>
                      <div class="form-group">
                         <label>No. Identitas</label>
                         <div class="row">
                            <div class="col-md-4">
                               <select class="form-control" name="id_pjawab">
                               </select>
                            </div>
                            <div class="col-md-8">
                               <input class="form-control" name="no_id_pjawab" placeholder="No. ID">
                            </div>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Hub. Keluarga</label>
                         <select class="form-control" name="hub_pjawab">
                         </select>
                      </div>
                   </div>
                </div>
            </div>
            <!-- Baris tombol -->
            <div class="panel-footer" id="form_footer">
                <div id="baris_tombol">
                  <button id="tombol_simpan" class="btn btn-primary btn-lg">Simpan</button>
                  <button id="tombol_cetak_SEP" class="btn btn-primary btn-lg">Cetak SEP</button>
                </div>
            </div>
          </form>
        </div>
        <!-- Tabel histori pasien -->
        <!-- End tab content -->
    </div>
</div>
