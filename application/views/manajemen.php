<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-4 col-lg-3">
						Menambahakan User Baru
					</div>					
				</div>				
			</div>
			<form class="form-horizontal" id="form" role="form" method="post">
				<div class="panel-body bg-blue-gradient">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
		                      <label class="control-label col-md-4">Username</label>
		                      <div class="col-md-8">
		                        <input class="form-control" name="userbaru" id="userbaru">
		                      </div>
		                    </div> 
		                    <div class="form-group">
		                      <label class="control-label col-md-4">Password</label>
		                      <div class="col-md-8">
		                        <input type="password" class="form-control" name="passbaru" id="passbaru">
		                      </div>
		                    </div> 
						</div>
					</div>
				</div>
				<div class="panel-footer" id="form_footer">
	                <div id="baris_tombol">
	                  <button id="tombol_simpan" class="btn btn-primary btn-lg">Simpan</button>
	                </div>
            	</div>
			</form>
		</div>		
	</div>	
</div>
<hr>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Opsi</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php if (isset($user)){ foreach ($user as $u) { ?>
			<tr>
				<td class="col-md-2">
					<?php echo $i ?>
				</td>
				<td class="col-md-4">
					<?php echo $u->USERNAME ?>
				</td>
				<td class="col-md-4"><button type="button" class="btn btn-danger tombol-hapus" data-id="<?php echo $u->USERNAME; ?>">Hapus</button></td>
			</tr>
			<?php $i++;
				}
			} 
			?>
		</tbody>
	</table>	
</div>
