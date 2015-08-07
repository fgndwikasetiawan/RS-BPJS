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
               <div class="col-md-3 col-md-offset-2" id="kolom_kiri">
                  <div class="row">
                     <div class="table-responsive">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td class="success col-md-3" ><b>No CM</b></td>
                                 <td class="info col-md-3" id="no_cm"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Nama</b></td>
                                 <td class="info col-md-3" id="nama"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Usia</b></td>
                                 <td class="info col-md-3" id="usia"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Jenis Kelamin</b></td>
                                 <td class="info col-md-3" id="sex"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Jenis Kelamin</b></td>
                                 <td class="info col-md-3" id="sex"></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

               <!-- kolom kanan -->
               <div class="col-md-3 col-md-offset-1" id="kolom_kanan">
                  <div class="row">
                     <div class="table-responsive">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>No BPJS</b></td>
                                 <td class="info col-md-3" id="no_bpjs"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>PISA</b></td>
                                 <td class="info col-md-3" id="pisa"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Tgl. Cetak</b></td>
                                 <td class="info col-md-3" id="tgl_cetak"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>Jenis Peserta</b></td>
                                 <td class="info col-md-3" id="jenis_peserta"></td>
                              </tr>
                           </tbody>
                           <tbody>
                              <tr>
                                 <td class="success col-md-3"><b>HAK Kelas</b></td>
                                 <td class="info col-md-3" id="hak_kelas"></td>
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
