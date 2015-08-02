<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-3">Cari pasien berdasarkan:</div>
               <div class="col-md-3">
                  <select id="tipe_cari" class="form-control">
                     <option value="medrec">No. CM</option>
                     <option value="bpjs">No. BPJS</option>
                  </select>
               </div>
               <div class="col-md-5 input-group">
                  <input class="form-control" id="nomor_cari" placeholder="No. CM / No. BPJS">
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="cari_pasien()"><i class="fa fa-search"></i></button>
                  </span>
               </div>
            </div>
         </div>
         <form role="form" class="form-small">
            <div class="panel-body bg-blue">
               <div class="row">
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class="col-md-7 form-group">
                           <label>Nama</label>
                           <input id="nama" class="form-control" name="nama">
                        </div>
                        <div class="col-md-5 form-group">
                           <label>Nama Keluarga</label>
                           <input id="nama_kel" class="form-control" name="nama_kel">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class="col-md-7 form-group">
                           <label>No. Rekam Medis</label>
                           <input id="no_cm" class="form-control" name="no_cm">
                        </div>
                        <div class="col-md-5 form-group">
                           <label>Tempat Kartu</label>
                           <input id="tempat_kartu" class="form-control" name="tempat_kartu">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <label>No. Kartu BPJS</label>
                     <input class="form-control" name="no_bpjs">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <label>Tempat/Tanggal Lahir</label>
                     <div class="row">
                        <div class="col-md-3">
                           <input class="form-control" name="tempat_lahir">
                        </div>
                        <div class="col-md-2">
                           <select class="form-control" name="tanggal_lahir">
                              <option>30</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                           <select class="form-control" name="bulan_lahir">
                              <option>Desember</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <select class="form-control" name="tahun_lahir">
                              <option>2015</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 form-group">
                     <label>Jenis Kelamin</label>
                     <select class="form-control" name="sex">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                     </select>
                  </div>
                  <div class="col-md-2 form-group">
                     <label>Kewarganegaraan</label>
                     <select class="form-control" name="kwn">
                        <option value="WNI">WNI</option>
                        <option value="WNA">WNA</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class ="col-md-4 form-group">
                           <label>Agama</label>
                           <select>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Status Kawin</label>
                           <select class="form-control" name="status">
                              <option>Sudah Menikah</option>
                              <option>Belum Menikah</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Gol. Darah</label>
                           <select class="form-control" name="gol_darah">
                              <option>0</option>
                              <option>A</option>
                              <option>AB</option>
                              <option>B</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class="col-md-6 form-group">
                           <label>Pekerjaan</label>
                           <input class="form-control" name="pekerjaan">
                        </div>
                        <div class="col-md-6 form-group">
                           <label>Pendidikan</label>
                           <select class="form-control" placeholder="pendidikan">
                              <option>SD</option>
                              <option>SMP</option>
                              <option>SMA</option>
                              <option>Sarjana</option>
                              <option>Magister</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class="col-md-8 form-group">
                           <label>Alamat</label>
                           <input class="form-control" name="alamat">
                        </div>
                        <div class="col-md-2 form-group">
                           <label>RT</label>
                           <input class="form-control" name="rt">
                        </div>
                        <div class="col-md-2 form-group">
                           <label>RW</label>
                           <input class="form-control" name="rw">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 form-group">
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Kelurahan</label>
                           <input class="form-control" name="id_kelurahan">
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Kecamatan</label>
                           <input class="form-control" name="id_kecamatan">
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Desa</label>
                           <input class="form-control" name="id_desa">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <div class="panel-footer" style="text-align: center;">
            <a href="pasien_lama.html" class="btn btn-primary" style="font-size:1.25em; padding-left: 20px; padding-right: 20px"> Tombol A</a>
            <a href="pasien_lama.html" class="btn btn-success" style="font-size:1.25em; padding-left: 20px; padding-right: 20px"> Tombol B</a>
            <a href="pasien_lama.html" class="btn btn-warning" style="font-size:1.25em; padding-left: 20px; padding-right: 20px"> Tombol C</a>
         </div>
      </div>
   </div>
</div>
