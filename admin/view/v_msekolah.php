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
<script src="client/s_msekolah.js"></script>
<!-- <h4><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h4> -->
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h3>
<ol class="breadcrumb">
  <li><a href="jenjang">Jenjang Pendidikan /</a> </li>
  <li class="active">Sekolah</li>
</ol>

<!-- <a href="?menu=vgol" id="golBC" class="btn btn-secondary"><i class='icon-arrow-left'></i> Golongan</a> -->
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
				<label class="control-label">Nama </label>
				<div class="controls" >
					<input name="namaTB" id="namaTB" required placeholder="Isikan Nama">
				</div>
				<span id="namaInfo"></span>
			</div>
	
			<div class="control-group">
				<label class="control-label">Jenjang</label>
				<div class="controls" >
					<select class="span2" name="id_mjenjangTB" id="id_mjenjangTB" required>
						<option value=''>pilih jenjang </option>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Propinsi</label>
					<div class="controls" >
						<select name="id_mpropinsiTB" id="id_mpropinsiTB" required>
							<option value=''>pilih Propinsi .. </option>
						</select>
					</div>
				<span id="namalInfo"></span>
			</div>
	
			<div class="control-group">
				<label class="control-label">Kota</label>
					<div class="controls" >
						<select name="id_mkotaTB" id="id_mkotaTB" required>
							<option value=''>pilih Propinsi dahulu .. </option>
						</select>
					</div>
				<span id="namalInfo"></span>
			</div>
	
			<div class="control-group">
				<label class="control-label">Kecamatan</label>
					<div class="controls" >
						<select name="id_mkecamatanTB" id="id_mkecamatanTB" required>
							<option value=''>pilih Kota dahulu ..</option>
						</select>
					</div>
				<span id="namalInfo"></span>
			</div>
	
			<div class="control-group">
				<label class="control-label">Alamat</label>
					<div class="controls" >
						<input name="alamatTB" id="alamatTB" required placeholder="Isikan Nama">
					</div>
				<span id="namalInfo"></span>
			</div>

			
			<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div id="v_kegPN"></br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
	<tr>
		<td></td>
		<td><input class="span2" placeholder="nama sekolah" name="namaTS" id="namaTS"></td>
		<td><input class="span1" placeholder="jenjang" name="mjenjangTS" id="mjenjangTS"></td>
		<td><input class="span1" placeholder="alamat" name="alamatTS" id="alamatTS"></td>
		<td><input class="span1" placeholder="Kecamatan" name="mkecamatanTS" id="mkecamatanTS"></td>
		<td><input class="span1" placeholder="Kota" name="mkotaTS" id="mkotaTS"></td>
		<td><input class="span1" placeholder="propinsi" name="mpropinsiTS" id="mpropinsiTS"></td>
		<td></td>
	</tr>
	<tr class="info">
		<td><b>No.</b></td>
		<td><b>Sekolah</b></td>
		<td><b>Jenjang</b></td>
		<td><b>Alamat</b></td>
		<td><b>Kecamatan</b></td>
		<td><b>Kota</b></td>
		<td><b>Propinsi</b></td>
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
