<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-4 col-lg-3" id="label_cari">Cari pasien berdasarkan:</div>
               <div class="col-md-3">
                  <select id="tipe_cari" class="form-control">
                     <option value="medrec">No. CM</option>
                     <option value="ktp">No. KTP</option>
                  </select>
               </div>
               <div class="col-md-4 col-lg-4">
                  <div class="input-group">
                     <input class="form-control" id="nomor_cari" placeholder="No. CM / No. KTP">
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="tombol_cari"><i class="fa fa-search fa-fw"></i></button>
                     </span>
                  </div>
               </div>
            </div>
         </div>
          <?php if (isset($no_cm)) { ?>
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
                              <td class="success col-xs-6 col-sm-4 col-md-2" ><b>No. CM</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="no_cm"><?php if (isset($no_cm)) echo $no_cm ?></td>
                              <?php if (isset($no_cm)) { ?><input type="hidden" id="input_no_cm" name="no_cm" value="<?php echo $no_cm;?>"> <?php } ?>
                            </tr>
                         </tbody>                         
                         <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Nama</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="nama"><?php if(isset($nama)) echo $nama ?></td>
                              <input type="hidden" name="input_nama" value="<?php if (isset($nama)) echo $nama; ?>">
                            </tr>
                         </tbody>
                         <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Tanggal Lahir</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="tgl_lahir"><?php if (isset($tgl_lahir)) echo $tgl_lahir ?></td>
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
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>No. BPJS</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="no_bpjs"><?php if (isset($no_bpjs)) echo $no_bpjs ?></td>
                              <input type="hidden" name="input_no_bpjs" value="<?php if (isset($no_bpjs)) echo $no_bpjs; ?>">
                            </tr>
                           </tbody>
                           <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Jenis Kelamin</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="sex"><?php if(isset($sex)) echo $sex ?></td>
                              <input type="hidden" name="input_sex" value="<?php if (isset($sex)) echo $sex; ?>">
                            </tr>
                            </tbody> 
                           <tbody>
                            <tr>
                              <td class="success col-xs-6 col-sm-4 col-md-2"><b>Usia</b></td>
                              <td class="info col-xs-6 col-sm-4 col-md-3" id="usia"><?php if (isset($usia)) echo $usia ?></td>
                            </tr>
                           </tbody>                           
                         </table>
                     </div>
                  </div>
                </div>
                <hr>
                <!-- Formulir pendaftaran poliklinik -->
                <div class="col-md-4" id="kolom_kiri">
                  <div class="form-group">
                    <label>No. Register</label>
                    <div class="input-group">
                        <input class="form-control" name="no_register" id="no_register" readonly>
                        <span class="input-group-btn">
                           <button type="button" class="btn btn-success" id="tombol_noreg"><i class="fa fa-plus"></i></button>
                        </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Nama Pembayar</label>
                    <input type="text" class="form-control" name="nmpembayar" id="nmpembayar" placeholder="Nama Pembayar">                     
                  </div>
                  <div class="form-group">      
                    <label>Hubungan Keluarga</label>
                    <select class="form-control" id="ketpembayar" name="ketpembayar">
                       <option value="ANAK">Anak</option>
                       <option value="ISTRI">Istri</option>
                       <option value="SUAMI">Suami</option>
                       <option value="OTUA">Orang Tua</option>
                       <option value="MTUA">Mertua</option>
                       <option value="YBS">Yang Bersangkutan</option>                         
                    </select>                     
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
                <div class="col-md-4">
                  <div class="form-group">                   
                    <label>Nama Perusahaan</label>
                    <select class="form-control" name="id_perusahaan" id="id_perusahaan">
                      <?php foreach($perusahaan as $p) { ?>
                        <option value="<?php echo $p->ID_KONTRAKTOR; ?>"><?php echo $p->NM_PERUSAHAAN; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>PPK Rujukan</label>
                    <input class="form-control" id="ppk_rujukan" name="ppk_rujukan">
                    <span class="note" id="nama_ppk"></span>
                  </div>
                  <div class="form-group">
                    <label>No. SJP/Rujukan Pers</label>
                    <input type="text" class="form-control" name="no_sjp" id="no_sjp">
                  </div>        
                  <div class="form-group">
                    <label>Poliklinik Tujuan</label>
                    <select class="form-control" name="id_poli" id="id_poli">
                      <?php foreach($poli as $p) { ?>
                        <option value="<?php echo $p->ID_POLI; ?>"><?php echo $p->NM_POLI; ?></option>
                      <?php } ?>
                    </select>
                    <input type="hidden" id="nm_poli" name="nm_poli" value="">
                  </div>
                  <div class="form-group">                      
                    <label>Kelas</label>
                    <select class="form-control" id="kelas_pasien" name="kelas_pasien">
                      <option value="I">I</option>
                      <option value="II">II</option>
                      <option value="III">III</option>                        
                    </select>                        
                  </div>
                </div>
                <!-- Kolom kanan -->
                <div class="col-md-4">                              
                  <div class="form-group">
                    <label>Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" id="anamnesa"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Diagnosa ICD1</label>                    
                    <input class="form-control" name="id_diagnosa" id="id_diagnosa">
                  </div>
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan"></textarea>
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
                </div>
            </div>
            <!-- Baris tombol -->
            <div class="panel-footer" id="form_footer">
                <div id="baris_tombol">
                  <button id="tombol_simpan" class="btn btn-primary btn-lg">Simpan</button>
                  
                </div>
            </div>
          </form>
        </div>
        <!-- Tabel histori pasien -->
        <label>Histori Pasien</label>
        <hr>
        <ul class="nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#pendaftaran">Pendaftaran</a></li>
           <li><a data-toggle="tab" href="#penjamin">Penjamin</a></li>
           <li><a data-toggle="tab" href="#diagnosa">Diagnosa</a></li>
        </ul>
        <div class="tab-content">
          <!-- Tab pendaftaran -->
          <div id="pendaftaran" class="tab-pane fade in active">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                   <th>#</th>
                    <th>Tanggal</th>
                    <th>No. Register</th>
                    <th>Poliklinik Tujuan</th>
                    <th>Cara Berkunjung</th>
                    <th>Cara Bayar</th>
                    <th>Kelas</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->TGL_KUNJUNGAN; ?></td>
                    <td><?php echo $h->NO_REGISTER; ?></td>
                    <td><?php echo $h->NM_POLI; ?></td>
                    <td><?php echo $h->CARA_KUNJ; ?></td>
                    <td><?php echo $h->CARA_BAYAR; ?></td>
                    <td><?php echo $h->KELAS_PASIEN; ?></td>
                    <td>
                       <button type="button" class="btn btn-primary tombol_cetak_sep" data-noreg="<?php echo $h->NO_REGISTER; ?>">Cetak SEP</button>
                       <button type="button" class="btn btn-danger tombol_hapus" data-id="<?php echo $no_cm; ?>" data-noreg="<?php echo $h->NO_REGISTER; ?>">Hapus</button>
                    </td>
                  </tr>
                  <?php
                    $i++;
                    }
                  } 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Tab penjamin -->
          <div id="penjamin" class="tab-pane fade">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Perusahaan</th>
                    <th>No. SJP/Rujukan Pers</th>
                    <th>Nama Pembayar</th>
                    <th>Hubungan Keluarga</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->NM_PERUSAHAAN; ?></td>
                    <td><?php echo $h->NO_SJP_ASKES; ?></td>
                    <td><?php echo $h->NMPEMBAYAR; ?></td>
                    <td><?php echo $h->KETPEMBAYAR; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary tombol_cetak_sep" data-noreg="<?php echo $h->NO_REGISTER; ?>">Cetak SEP</button>
                       <button type="button" class="btn btn-danger tombol_hapus" data-id="<?php echo $no_cm; ?>" data-noreg="<?php echo $h->NO_REGISTER; ?>">Hapus</button>
                    </td>
                  </tr>
                  <?php
                    $i++;
                    }
                  } 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Tab diagnosa -->
          <div id="diagnosa" class="tab-pane fade">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Anamnesa</th>
                    <th>Diagnosa ICD1</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->ANAMNESA; ?></td>
                    <td><?php echo $h->NM_DIAGNOSA; ?></td>
                    <td>
                       <button type="button" class="btn btn-primary tombol_cetak_sep" data-noreg="<?php echo $h->NO_REGISTER; ?>">Cetak SEP</button>
                       <button type="button" class="btn btn-danger tombol_hapus" data-id="<?php echo $no_cm; ?>" data-noreg="<?php echo $h->NO_REGISTER; ?>">Hapus</button>
                    </td>
                  </tr>
                  <?php
                    $i++;
                    }
                  } 
                  ?>                  
                </tbody>
              </table>
            </div>
          </div>
        </div> 
        
          <?php } ?>
          
        <!-- End tab content -->
    </div>
</div>
