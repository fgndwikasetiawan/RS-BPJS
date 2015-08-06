<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-4 col-lg-3" id="label_cari">Poliklinik</div>
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
         <form role="form" class="formsmall-" method="post">
            <div class="panel-body bg-blue-gradient">
               <!--Kolom kiri-->
               <div class="col-md-2" id="kolom_kiri">
                  <div class="row">
                     <div class="table-responsive">
                        <table class="table col-md-3">
                           <tbody>
                              <tr class="success">
                                 <td><label>No CM</label></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Nama</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Usia</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Jenis Kelamin</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Jenis Kelamin</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-2" id="kolom_kiri">
                  <div class="row">
                     <table class="table col-md-3">
                        <tbody>
                           <tr class="info">
                              <!-- <td><label></label></td> -->
                           </tr>
                        </tbody>
                        <tbody>
                           <tr class="info">
                              <!-- <td><label></label></td> -->
                              <!-- <td></td> -->
                           </tr>
                        </tbody>
                        <tbody>
                           <tr class="info">
                              <!-- <td><label></label></td> -->
                              <!-- <td></td> -->
                           </tr>
                        </tbody>
                        <tbody>
                           <tr class="info">
                              <!-- <td><label></label></td> -->
                              <!-- <td></td> -->
                           </tr>
                        </tbody>
                        <tbody>
                           <tr class="info">
                              <!-- <td><label> </label></td> -->
                              <!-- <td></td> -->
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>

               <!-- kolom kanan -->
               <div class="col-md-2 col-md-offset-2" id="kolom_kiri">
                  <div class="row">
                     <div class="table-responsive">
                        <table class="table col-md-3">
                           <tbody>
                              <tr class="success">
                                 <td><label>No BPJS</label></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>PISA</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Tgl. Cetak</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>Jenis Peserta</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                           <tbody>
                              <tr class="success">
                                 <td><label>HAK Kelas</label></td>
                                 <!-- <td></td> -->
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

            </div>
            
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
                            <th>Ruang</th>
                            <th>Poliklinik Tujuan</th>
                            <th>Cara Berkunjung</th>
                            <th>Cara Bayar</th>
                            <th>Kelas</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                          </tr>
                          <tr>
                            <td>2</td>
                          </tr>
                          <tr>
                            <td>3</td>
                          </tr>
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
                        <tr>
                          <td>1</td>
                        </tr>
                        <tr>
                          <td>2</td>
                        </tr>
                        <tr>
                          <td>3</td>
                        </tr>
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
                        <tr>
                          <td>1</td>
                        </tr>
                        <tr>
                          <td>2</td>
                        </tr>
                        <tr>
                          <td>3</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

          </form>
        <div class="panel-footer" id="form_footer">
        </div>
      </div>
    </div>
</div>
