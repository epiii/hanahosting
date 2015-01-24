<style>
	#loadarea{
		height:45px;
	}#pagination{
		color:white;list-style:none;
	}.vwimg{
		height:80px;
		opacity:0.8;
	}.vwimg:hover{
		opacity:1;
	}.error-info{
		/*padding: .2em .6em .3em;*/
		padding: .4em;
		font-size: 75%;
		font-weight: bold;
		line-height: 1;
		color: #ffffff;
		border-radius: .25em;
		background-color:red;
	}.trtable:hover{
		background-color:#3FC;
	}.upperizer{
		text-transform:uppercase;
	}.capitizer{
		text-transform:capitalize;
	}
</style>

<script src="client/s_madmin.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR mkotaONGAN</div></h3>
<ol class="breadcrumb">
  <li><a href="aturan">Aturan / </a></li>
  <li class="active">mkotaongan / </li>
  <li><a href="jabatan">Jabatan</a></li>
</ol>

<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- <a href="jabatan"id="jabBC" class="btn btn-secondary">Jabatan <i class='icon-arrow-right'> </i></a> -->
</div>
	


<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<div class="control-group">
			<label class="control-label">Username</label>
			<div class="controls" >
				<select name="id_mloginTB" id="id_mloginTB" required>
					<option value=''>pilih Username ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Nama</label>
			<div class="controls" >
				<input name="namaTB" id="namaTB" required placeholder="Nama">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">NO Telp</label>
			<div class="controls" >
				<input name="notelTB" id="notelTB" required placeholder="No Telp">
			</div>
			<span id="madmin1"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Jabatan</label>
			<div class="controls" >
				<input name="jabatanTB" id="jabatanTB" required placeholder="Jabatan">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div class="span8"id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span1" placeholder="Nama" name="namaTS" id="namaTS"></td>
			<td><input class="span1" placeholder="No Telp" name="no_telpTS" id="no_telpTS"></td>
			<td><input class="span1" placeholder="Jabatan" name="jabatanTS" id="jabatanTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama</b></td>
			<td><b>No Telp</b></td>
			<td><b>Jabatan</b></td>
			<td colspan="2"><b>Action</b>
			</td>
		</tr>

		<tbody id="isi">

		</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
