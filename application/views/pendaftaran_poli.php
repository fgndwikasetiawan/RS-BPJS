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
            </div>
         </div>
          <form id="form" role="form" target="_blank" method="post">
            <div class="panel-body bg-blue-gradient">
               <!--Kolom kiri-->               
                <div class="row">
                  <div class="col-md-4 col-md-offset-2">
                    <div class="table-responsive">
                      <table class="table center-table">
                         <tbody>
                            <tr>
                               <td class="success col-md-2" ><b>No CM</b></td>
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
                               <td class="success col-md-2"><b>Jenis Kelamin</b></td>
                               <td class="info col-md-3" id="sex"><?php if(isset($sex)) echo $sex ?></td>
                               <input type="hidden" name="input_sex" value="<?php if (isset($sex)) echo $sex; ?>">
                            </tr>
                         </tbody>                           
                      </table>
                    </div>
                  </div>
                  <div class="col-md-4">
                     <div class="table-responsive">
                        <table class="table">
                          <tbody>
                              <tr>
                                 <td class="success col-md-2"><b>No BPJS</b></td>
                                 <td class="info col-md-3" id="no_bpjs"><?php if (isset($no_bpjs)) echo $no_bpjs ?></td>
                                 <input type="hidden" name="input_no_bpjs" value="<?php if (isset($no_bpjs)) echo $no_bpjs; ?>">
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-2"><b>Usia</b></td>
                                 <td class="info col-md-3" id="usia"><?php if (isset($usia)) echo $usia ?></td>
                                 <input type="hidden" name="tgl_lahir" value="<?php if (isset($tgl_lahir)) echo $tgl_lahir; ?>">
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-2"><b>Tanggal Cetak</b></td>
                                 <td class="info col-md-3" id="tgl_cetak"></td>
                              </tr>
                           </tbody>
                         </table>
                     </div>
                  </div>
                </div>
                <hr>


                <div class="col-md-3 col-md-offset-1">
                  <div class="row">
                    <label>Nama Peserta</label>
                    <input type="text" class="form-control" name="npembayar" id="npembayar">                     
                  </div>
                  <div class="row">      
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
                  <div class="row">                      
                    <label>Cara Berkunjung</label>
                    <select class="form-control" name="cara_kunj" id="cara_kunj">
                      <?php foreach($kunj as $k) { ?>
                        <option value="<?php echo $k->CARA_KUNJ; ?>"><?php echo $k->CARA_KUNJ; ?></option>
                      <?php } ?>
                    </select>                     
                  </div>
                  <div class="row">                      
                    <label>Kelas</label>
                    <select class="form-control" id="kelas" name="kelas">
                      <option value="I">I</option>
                      <option value="II">II</option>
                      <option value="III">III</option>                        
                    </select>                        
                  </div>
                </div>

                <div class="col-md-3 col-md-offset-1">
                  <div class="row">                   
                    <label>Nama Perusahaan</label>
                    <select class="form-control" name="nm_perusahaan" id="nm_perusahaan">
                      <?php foreach($perusahaan as $p) { ?>
                        <option value="<?php echo $p->ID_KONTRAKTOR; ?>"><?php echo $p->NM_PERUSAHAAN; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="row">
                    <label>Cara Bayar</label>
                    <select class="form-control" name="cara_bayar" id="cara_bayar">
                      <?php foreach($bayar as $b) { ?>
                        <option value="<?php echo $b->CARA_BAYAR; ?>"><?php echo $b->CARA_BAYAR; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="row">
                    <label>No SJP/Rujukan Pers</label>
                    <input type="text" class="form-control" name="no_sjp" id="no_sjp">
                  </div>
                  <div class="row">
                    <label>No Register</label>
                    <input type="text" class="form-control" name="nama_kel" id="nama_kel">
                  </div>
                  
                </div>

                <div class="col-md-3 col-md-offset-1">
                  <div class="row">
                    <label>Poliklinik Tujuan</label>
                    <select class="form-control" name="nm_poli" id="nm_poli">
                      <?php foreach($poli as $p) { ?>
                        <option value="<?php echo $p->ID_POLI; ?>"><?php echo $p->NM_POLI; ?></option>
                      <?php } ?>
                    </select>
                    <input type="hidden" id="input_nama_poli" name="input_nama_poli" value="">
                  </div>
                  <div class="row">
                    <label>Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" id="anamnesa"></textarea>
                  </div>
                  <div class="row">
                    <label>Diagnosa ICD10</label>
                    <textarea class="form-control" name="nm_diagnosa" id="nm_diagnosa"></textarea>
                  </div>
                </div>

            </div>

          
            <div class="panel-footer" id="form_footer">
              <!-- <div class="row"> -->
                <div id="baris_tombol">
                  <button id="tombol_simpan" class="btn btn-primary btn-lg">Simpan</button>
                  <button id="tombol_cetak_SEP" class="btn btn-primary btn-lg">Cetak SEP</button>
                </div>
              <!-- </div> -->
            </div>
          </form>
        </div>
        <div>Histori Pasien</div>

        <ul class="nav nav-tabs">
           <li class="active"><a data-toggle="tab" href="#pendaftaran">Pendaftaran</a></li>
           <li><a data-toggle="tab" href="#penjamin">Penjamin</a></li>
           <li><a data-toggle="tab" href="#diagnosa">Diagnosa</a></li>
        </ul>

        <div class="tab-content">
          <div id="pendaftaran" class="tab-pane fade in active">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                   <th>#</th>
                    <th>Tanggal</th>
                    <th>No Register</th>
                    <!-- <th>Ruang</th> -->
                    <th>Poliklinik Tujuan</th>
                    <th>Cara Berkunjung</th>
                    <th>Cara Bayar</th>
                    <th>Kelas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>

                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->TGL_KUNJUNGAN; ?></td>
                    <td><?php echo $h->NO_REGISTER; ?></td>
                    <!-- <td><?php echo $h->KD_RUANG; ?></td> -->
                    <td><?php echo $h->NM_POLI; ?></td>
                    <td><?php echo $h->CARA_KUNJ; ?></td>
                    <td><?php echo $h->CARA_BAYAR; ?></td>
                    <td><?php echo $h->KELAS_PASIEN; ?></td>
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

          <div id="penjamin" class="tab-pane fade">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Perusahaan</th>
                    <th>No SJP/Rujukan Pers</th>
                    <th>Nama Peserta</th>
                    <th>Hubungan Keluarga</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>

                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->NM_PERUSAHAAN; ?></td>
                    <td></td>
                    <!-- <td><?php echo $h->NO_REGISTER; ?></td> -->
                    <td><?php echo $h->NMPEMBAYAR; ?></td>
                    <td><?php echo $h->KETPEMBAYAR; ?></td>
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

          <div id="diagnosa" class="tab-pane fade">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Anamnesa</th>
                    <th>Diagnosa ICD10</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php  if(isset($historis)) {foreach ($historis as $h) { ?>

                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $h->ANAMNESA; ?></td>
                    <td><?php echo $h->NAMA_DIAGNOSA; ?></td>
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
    </div>
</div>
