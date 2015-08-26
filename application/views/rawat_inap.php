<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-4 col-lg-3" id="label_cari">Cari pasien berdasarkan:</div>
               <div class="col-md-3">
                  <select id="tipe_cari" class="form-control">
                     <option value="reg_irj">No. Reg. IRJ</option>
                     <option value="ipd">No. IPD</option>
                  </select>
               </div>
               <div class="col-md-4 col-lg-4">
                  <div class="input-group">
                     <input class="form-control" id="nomor_cari" placeholder="No. Reg. IRJ / No. IPD">
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="cari_pasien()"><i class="fa fa-search fa-fw"></i></button>
                     </span>
                  </div>
               </div>
            </div>
         </div>
          <form class="form-horizontal" id="form" role="form" target="_blank" method="post">
            <div class="panel-body bg-blue-gradient">
               <!--Kolom kiri-->               
                <div class="row">
                  <!-- Tabel data pasien -->
                  <div class="col-md-4 col-md-offset-2">
                    <div class="table-responsive">
                      <table class="table center-table">
                         <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2" ><b>No. CM</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="no_cm"><?php if (isset($pasien->NO_MEDREC)) echo $pasien->NO_MEDREC; ?></td>
                              <?php if (isset($no_cm)) { ?><input type="hidden" id="input_no_cm" name="no_cm" value="<?php echo $pasien->NO_MEDREC;?>"> <?php } ?>
                            </tr>
                         </tbody>                         
                         <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Nama</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="nama"><?php if(isset($pasien->NAMA)) echo $pasien->NAMA ?></td>
                              <input type="hidden" name="input_nama" value="<?php if (isset($pasien->NAMA)) echo $pasien->NAMA; ?>">
                            </tr>
                         </tbody>
                         <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Tanggal Lahir</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="tgl_lahir"><?php if (isset($pasien->TGL_LAHIR)) echo $pasien->TGL_LAHIR; ?></td>
                              <input type="hidden" name="input_tgl_lahir" value="<?php if (isset($pasien->TGL_LAHIR)) echo $pasien->TGL_LAHIR; ?>">
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
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>No. BPJS</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="no_bpjs"><?php if (isset($pasien->NO_ASURANSI)) echo $pasien->NO_ASURANSI; ?></td>
                              <input type="hidden" name="input_no_bpjs" value="<?php if (isset($pasien->NO_ASURANSI)) echo $pasien->NO_ASURANSI; ?>">
                            </tr>
                           </tbody>
                           <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Jenis Kelamin</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="sex"><?php if(isset($pasien->SEX)) echo $pasien->SEX ?></td>
                              <input type="hidden" name="input_sex" value="<?php if (isset($pasien->SEX)) echo $pasien->SEX; ?>">
                            </tr>
                            </tbody> 
                           <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Usia</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="usia"><?php if (isset($pasien->UMUR)) echo $pasien->UMUR ?></td>
                            </tr>
                           </tbody>                           
                         </table>
                     </div>
                  </div>
                </div>
                <hr>
                <!-- Form -->

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label col-md-4">No. Register IRJ</label>
                      <div class="col-md-8">
                        <input class="form-control" name="regasal" id="regasal" value="<?php if (isset($pasien->REGASAL)) echo $pasien->REGASAL; ?>">
                      </div>
                    </div>           
                    <div class="form-group">
                      <label class="control-label col-md-4">No. IPD</label>
                        <div class="col-md-8">                        
                          <div class="input-group">
                             <input class="form-control" type="text" id="no_ipd" name="no_ipd" value="<?php if (isset($pasien->NO_IPD)) echo $pasien->NO_IPD; ?>">
                             <span class="input-group-btn">
                                <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                             </span>
                          </div>
                        </div>
                    </div>                
                    <div class="form-group">
                      <label class="control-label col-md-4">No. Register Ibu</label>
                        <div class="col-md-8">
                          <input class="form-control" name="noipdibu" id="noipdibu" value="<?php if (isset($pasien->NOIPDIBU)) echo $pasien->NOIPDIBU; ?>">
                        </div>
                    </div>                       
                    <div class="form-group">
                      <label class="control-label col-md-4">Tanggal Daftar <span id="usia">&nbsp;</span></label>
                        <div class="col-md-8">
                          <timepicker name="tgldaftarri" id="tgldaftarri" value="<?php if (isset($pasien->TGLDAFTARRI)) echo $pasien->TGLDAFTARRI; ?>"></timepicker>                          
                        </div>                                             
                    </div>
                    <div class="form-group">      
                      <label class="control-label col-md-4">SMF</label>
                      <div class="col-md-8">
                        <select class="form-control" id="id_smf" name="id_smf">                         
                        </select>
                      </div>                                           
                    </div>                    
                    <div class="form-group">
                      <label class="control-label col-md-4">Cara Bayar</label>
                      <div class="col-md-8">
                        <select class="form-control" name="cara_bayar" id="cara_bayar">
                          <?php foreach($bayar as $b) { ?>
                            <option value="<?php echo $b->CARA_BAYAR; ?>"><?php echo $b->CARA_BAYAR; ?></option>
                          <?php } ?>
                        </select>
                      </div>                        
                    </div> 
                    <div class="form-group">                      
                      <label class="control-label col-md-4">Cara Berkunjung</label>
                      <div class="col-md-8">
                        <select class="form-control" name="cara_kunj" id="cara_kunj">
                          <?php foreach($kunj as $k) { ?>
                            <option value="<?php echo $k->CARA_KUNJ; ?>"><?php echo $k->CARA_KUNJ; ?></option>
                          <?php } ?>
                        </select>
                      </div>                                             
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">Dokter</label>
                      <div class="col-md-8">
                        <select class="form-control" id="dokter" name="id_dokter">                         
                        </select>
                      </div>                     
                    </div> 
                  </div>

                  <div class="col-md-4">
                     <label class="form-title">Penjamin</label>
                    <div class="form-group">
                      <label class="control-label col-md-4">No.SJP / No. Surat</label>
                      <div class="col-md-8">
                        <input class="form-control" id="nosjp" name="nosjp" value="<?php if (isset($pasien->NOSJP)) echo $pasien->NOSJP; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">Perusahaan</label>
                      <div class="col-md-8">
                        <select class="form-control" name="id_kontraktor" id="id_kontraktor" value="<?php if (isset($pasien->ID_KONTRAKTOR)) echo $pasien->ID_KONTRAKTOR; ?>"></select>                        
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">No. Peserta</label>
                      <div class="col-md-8">
                        <input class="form-control" name="nopembayarri" id="nopembayarri" value="<?php if (isset($pasien->NOPEMBAYARRI)) echo $pasien->NOPEMBAYARRI; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">No. SEP</label>
                      <div class="col-md-8">
                        <div class="input-group">
                          <input type="text" class="form-control" name="no_sep" id="no_sep" readonly>
                            <span class="input-group-btn">
                              <button class="btn btn-success" style="font-size: 12px; line-height: 18px;" type="button" id="tombol_sep"><i class="fa fa-plus"></i></button>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">Nama Peserta</label>
                      <div class="col-md-8">
                        <input class="form-control" name="nmpembayarri" id="nmpembayarri" value="<?php if (isset($pasien->NMPEMBAYARRI)) echo $pasien->NMPEMBAYARRI; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">Ket. Pembayar</label>
                      <div class="col-md-8">
                        <select class="form-control" name="ketpembayarri" id="ketpembayarri"></select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-offset-1">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-6">Golongan</label>
                            <div class="col-md-6">
                             <input class="form-control" name="golpembayarri" id="golpembayarri" value="<?php if (isset($pasien->GOLPEMBAYARRI)) echo $pasien->GOLPEMBAYARRI; ?>">  
                            </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-4">Jatah Kelas</label>
                            <div class="col-md-6">
                              <input class="form-control" name="jatahklsiri" id="jatahklsiri" value="<?php if (isset($pasien->JATAHKLSIRI)) echo $pasien->JATAHKLSIRI; ?>"> 
                            </div>
                          </div>
                        </div>
                      </div>  
                    </div>
                  </div> 

                  <div class="col-md-4">
                     <label class="form-title">Keluarga</label>
                    <div class="form-group">
                      <label class="control-label col-md-3">Nama</label>
                      <div class="col-md-8"> 
                        <input class="form-control" name="nmpjawabri" id="nmpjawabri" value="<?php if (isset($pasien->NMPJAWABRI)) echo $pasien->NMPJAWABRI; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Alamat</label>
                      <div class="col-md-8">
                        <input class="form-control" name="alamatpjawabri" id="alamatpjawabri" value="<?php if (isset($pasien->ALAMATPJAWABRI)) echo $pasien->ALAMATPJAWABRI; ?>"> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">No.Telp / HP</label>
                      <div class="col-md-8">
                        <input class="form-control" name="notlppjawab" id="notlppjawab" value="<?php if (isset($pasien->NOTLPPJAWAB)) echo $pasien->NOTLPPJAWAB; ?>">   
                       </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">No. Identitas</label>
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-4">
                            <select class="form-control" name="kartuidpjawab">
                            </select>
                          </div>
                          <div class="col-md-8">
                            <input class="form-control" name="noidpjawab" id="noidpjawab" placeholder="No. ID" value="<?php if (isset($pasien->NOIDPJAWAB)) echo $pasien->NOIDPJAWAB; ?>">
                          </div>
                        </div>
                      </div>
                    </div>                      
                    <div class="form-group">
                      <label class="control-label col-md-3">Hub. Keluarga</label>
                      <div class="col-md-8">
                        <select class="form-control" name="hubpjawabri" id="hubpjawabri">
                        </select>
                      </div>
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
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Ruang</th>
                <th>Tanggal Masuk</th>
                <th>Kelas</th>
                <th>Bed</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="tr">
                <td class="col-md-3">
                  <select class="form-control" id="ruang" name="id_ruang">                         
                  </select>
                </td>
                <td class="col-md-3">
                  <timepicker name="tgl_masuk"></timepicker>
                </td>
                <td class="col-md-3">
                  <select class="form-control" id="kelas" name="kelas">                         
                  </select> 
                </td>
                <td class="col-md-3">
                  <select class="form-control" id="bed" name="bed">                         
                    </select>
                </td>
                <td>
                  <button type="button" class="btn btn-success">Tambah</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
          <!-- </div> -->
        <!-- <form class="form-horizontal" id="form" role="form" target="_blank" method="post">
          <div class="panel-body bg-blue-gradient">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label col-md-3">Ruang</label>
                  <div class="col-md-8">                            
                    <select class="form-control" id="ruang" name="id_ruang">                         
                    </select>                     
                  </div>
                </div>  
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label col-md-4">Tanggal Masuk</label>
                    <div class="col-md-8">
                      <timepicker name="tgl_masuk"></timepicker>
                    </div>                        
                </div> 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label col-md-3">Kelas</label>
                  <div class="col-md-8">                          
                    <select class="form-control" id="kelas" name="kelas">                         
                    </select>                     
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label col-md-3">Bed</label>
                  <div class="col-md-8">                            
                    <select class="form-control" id="bed" name="bed">                         
                    </select>                     
                  </div>
                </div>
              </div>
            </div>  
          </div>
          <div class="panel-footer" id="form_footer">
            <div id="baris_tombol">
              <button id="tombol_simpan" class="btn btn-primary btn-lg">Simpan</button>
              <button id="tombol_cetak_SEP" class="btn btn-primary btn-lg">Cetak SEP</button>
            </div>
          </div>
        </form> -->
        <!-- End tab content -->
    </div>
</div>
