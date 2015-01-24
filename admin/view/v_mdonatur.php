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
		background-color:re5;
	}.trtable:hover{
		background-color:#3FC;
	}.upperizer{
		text-transform:uppercase;
	}.capitizer{
		text-transform:capitalize;
	}

</style>
<script src="client/s_mdonatur.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR DONATUR</div></h3>
<!-- <ol class="breadcrumb">
  <li class="active">Alamat /</li>
  <li ><a href="subunsur"> Sub Unsur </a>/</li>
  <li> <a href="unsur">Unsur</a></li>
</ol>
 -->
<div>
	<!-- <button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button> -->
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>

<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>

		<div class="control-group">
			<label class="control-label">Kota (di Jawa Timur)</label>
			<div class="controls" >
				<select class="span3" name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih kota ...</option>
				</select>
			</div>
			<span id="subunsurInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<input type="text" class="span3" name="namaTB" id="namaTB" placeholder="kecamatan" required>
			</div>
			<span id="Info"></span>
		</div>
		
		
		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<!-- <divX id="loadtabel"></divX> -->

<div class="table-responsive" id="v_kegPN">
<!-- <br> -->
	<table class="table table-hover table-bordered table-striped" Xwidth="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span1" placeholder="nama" name="namaTS" id="namaTS"></td>
			<td><select class="span1" name="j_kelaminTS" id="j_kelaminTS">
					<option value="">Semua</option>
					<option value="L">Laki</option>
					<option value="P">Perempuan</option>
				</select></td>
			<td><input class="span1" placeholder="alamat" name="alamatTS" id="alamatTS"></td>
			<td><input class="span1" placeholder="kode pos" name="kode_posTS" id="kode_posTS"></td>
			<td><input class="span1" placeholder="kecamatan" name="mkecamatanTS" id="mkecamatanTS"></td>
			<td><input class="span1" placeholder="kota" name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="propinsi" name="mpropinsiTS" id="mpropinsiTS"></td>
			<td><input class="span1" placeholder="telpon" name="telpTS" id="telpTS"></td>
			<td><input class="span1" placeholder="HP" name="hpTS" id="hpTS"></td>
			<td><input class="span1" placeholder="Email" name="emailTS" id="emailTS"></td>
			<!-- <td></td> -->
		</tr>
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama</b></td>
			<td><b>Gender</b></td>
			<td><b>Alamat</b></td>
			<td><b>Kode Pos</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kota</b></td>
			<td><b>Propinsi</b></td>
			<td><b>Telp</b></td>
			<td><b>HP</b></td>
			<td><b>Email</b></td>
			<!-- <td colspan="2"><b>Aksi</b></td> -->
		</tr>

		<tbody id="isi"></tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<!-- <div class="row" id="isi"></div> -->
</div>
