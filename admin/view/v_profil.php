<script language="javascript" type="text/javascript" src="../js/plugins/bootstrap-datepicker.js"></script>
<script src="client/s_profil.js"></script>
<style>
#loadarea{
	height:15px;}
.capitizer{
	text-transform:capitalize;
}</style>

<!-- content -->
<h3></h3>
<div id="loadarea" ></div> 
<div class="container">
    	<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">
			<ul class="nav nav-tabs">
<!-- 				<li class="active">
					<a href="#panel1" data-toggle="tab" style="color:#080"><b>Data Login</b></a>
				</li>
				<li>                    
					<a href="#panel2" data-toggle="tab" style="color:#080"><b>Data Pribadi</b></a>
				</li>
 -->				<!-- <li>
					<a href="#panel3" data-toggle="tab" style="color:#080"><b>Data Jabatan</b></a>
				</li> -->
			
				<li class="pull-right">
					<!-- <button onclick="return cetakpfolio();" class="btn btn-secondary"><i class="icon-print"></i> portofolio</button> -->
					<button onclick="return hapusAkun();" class="btn btn-danger"><i class="icon-trash"></i> hapus akun</button>
				</li>
			</ul>
			
			<form class="form-horizontal" >
				<div class="tab-content">
					<!-- login data -->
					<div align="center" class="tab-pane active" id="panel1">
						<div class="control-group">
							<table class="table table-striped" width="100%" border="0">
								<tr id="usernameTR">
									<td width="25%"><label class="control-label">Email</label></td>
									<td width="5%"><label class="control-label"> :</label></td>
									<td width="70%" id="emailTD"></td>
								</tr>
                                
								<tr id="gantiDV">
									<!--password-->
								</tr>
								
								<tr id="pass1" style="display:none;">
									 <td width="25%"><label class="control-label">password lama</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passLTB"></td>
								 </tr>
								 <tr id="pass2"  style="display:none;">
									 <td width="25%"><label class="control-label">password baru</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passBTB1"></td>
								 </tr>
								 <tr id="pass3"  style="display:none;">
									 <td width="25%"><label class="control-label">password baru (ketik ulang)</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passBTB2" name="passBTB2"><span id="passinfo"></span></td>
								 </tr>
								 							<tr>
								<td width="25%"><label class="control-label">Nama Lengkap</label></td>
								<td width="5%"><label class="control-label"> : <input type="hidden" id="id_malamatH" name="id_malamatH"></label></td>
								<td width="70%" id="namaTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">No Telepon</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="no_telpTD"></td>
	 						</tr>
<!-- 	                        <tr>
								<td width="25%"><label class="control-label">Jenis Kelamin</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer" id="j_kelaminTD"></td>
	 						</tr>
 --><!-- 	 						<tr id="pass1" style="display:none;">
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="pre_malamatTD"></td>
							</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Alamat</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="malamatTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kode Pos</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="kode_posTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Propinsi</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mpropinsiTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kota</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mkotaTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kecamatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mkecamatanTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">No Handphone</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="hpTD"></td>
	 						</tr>	                        

 -->							</table>
						</div>
                            
						<div class="form-actions">
						</div>
					</div>
					<div  align="center"class="tab-pane" id="panel2">
						<table class="table table-striped" width="100%" border="0">
<!-- 							<tr>
								<td width="25%"><label class="control-label">Nama Lengkap</label></td>
								<td width="5%"><label class="control-label"> : <input type="hidden" id="id_malamatH" name="id_malamatH"></label></td>
								<td width="70%" id="namaTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Jenis Kelamin</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer" id="j_kelaminTD"></td>
	 						</tr>
	 						<tr id="pass1" style="display:none;">
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="pre_malamatTD"></td>
							</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Alamat</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="malamatTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kode Pos</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="kode_posTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Propinsi</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mpropinsiTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kota</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mkotaTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kecamatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="id_mkecamatanTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">No Telepon</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="telpTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">No Handphone</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" class="capitizer"  id="hpTD"></td>
	 						</tr>	                        
 -->						</table>
					</div>
					<!-- end of bio data -->
			</div>
			<input type="submit" value="Simpan"class="btn btn-primary" style="display:none;">
			<a href="profil" style="display:none;" class="btn btn-primary" id='cancelBC'>Batal</a>
			<a class="btn btn-primary" id='editBC'>Ubah</a>
			<div>.</div>
			<div>.</div>
		</form>
	</div>
</div>