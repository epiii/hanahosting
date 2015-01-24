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

<script src="client/s_mlembaga.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR PENYALUR</div></h3>
<!-- <ol class="breadcrumb">
  <li><a href="aturan">Aturan / </a></li>
  <li class="active">mkotaongan / </li>
  <li><a href="jabatan">Jabatan</a></li>
</ol>
 -->
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>
	


<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		
		<div class="control-group">
			<label class="control-label">Propinsi</label>
			<div class="controls" >
				<select name="id_mpropinsiTB" id="id_mpropinsiTB" required>
					<option value=''>pilih Propinsi ...</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Kota</label>
			<div class="controls" >
				<select name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih Kota ...</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecamatanTB" id="id_mkecamatanTB" required>
					<option value=''>pilih kecamatan ...</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">lembaga</label>
			<div class="controls" >
				<input name="mlembagaTB" id="mlembagaTB" required placeholder="lembaga">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">alamat</label>
			<div class="controls" >
				<input name="alamatTB" id="alamatTB" required placeholder="alamat">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">No telepon</label>
			<div class="controls" >
				<input name="notelpTB" id="notelpTB" required placeholder="No telepon">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Koordinator</label>
			<div class="controls" >
				<input name="koorTB" id="koorTB" required placeholder="Koordinator">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">NO Koordinator</label>
			<div class="controls" >
				<input name="nokoorTB" id="nokoorTB" required placeholder="NO Koordinator">
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

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span1" placeholder="Lembaga" name="mlembagaTS" id="mlembagaTS"></td>
			<td><input class="span1" placeholder="alamat" name="alamatTS" id="alamatTS"></td>
			<td><input class="span1" placeholder="telpon" name="mkecamatanTS" id="mkecamatanTS"></td>
			<td><input class="span1" placeholder="kota" name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="propinis" name="mpropinsiTS" id="mpropinsiTS"></td>
			<td><input class="span1" placeholder="telp" name="no_telpTS" id="no_telpTS"></td>
			<td><input class="span1" placeholder="koordinator" name="koordinatorTS" id="koordinatorTS"></td>
			<td><input class="span1" placeholder="telp koordinator" name="no_telpkoordTS" id="no_telpkoordTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Lembaga</b></td>
			<td><b>Alamat</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kota</b></td>
			<td><b>Propinsi</b></td>
			<td><b>no Kantor</b></td>
			<td><b>Koordinator</b></td>
			<td><b>No Koordinator</b></td>
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
