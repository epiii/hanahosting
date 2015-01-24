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

<script src="client/s_ddonatur1.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR PENGATURAN DONASI (RUTIN)</div></h3>
<ol class="breadcrumb">
  <li class="active">Pengaturan Donasi Rutin / </a></li>
  <li><a href="rekap-donasi-rutin">Donasi Rutin</a></li>
</ol>

<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>

<!--panel 1-->
<div Xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div Xclass="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<input type="hidden" id="id_malamatH" name="id_malamatH"/>
		
		<legend>Data Penagihan Donasi</legend>

		<div class="control-group">
			<label class="control-label">Tanggal Penagihan</label>
			<div class="controls" >
				<select name="tgl_ambilTB" id="tgl_ambilTB" required >
					<option value="">pilih tanggal penagihan ...</option>
					<option value="1-10">1 s/d 10 </option>
					<option value="11-20">11 s/d 20</option>
					<option value="21-30">21 s/d 30</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Tempat Penagihan</label>
			<div class="controls" >
				<select name="tipeTB" id="tipeTB" required >
					<option value="">pilih tempat penagihan ...</option>
					<option value="rumah">rumah </option>
					<option value="kantor">kantor</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Kantor</label>
			<div class="controls" >
				<input readonly name="pre_malamatTB" id="pre_malamatTB" placeholder="kantor">
			</div>
			<span style="color:red;">* tidak wajib</span>
		</div>

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
					<option value=''>pilih Propinsi Dahulu ...</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecamatanTB" id="id_mkecamatanTB" required>
					<option value=''>Pilih Kota Dahulu ...</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">alamat</label>
			<div class="controls" >
				<input name="malamatTB" id="malamatTB" required placeholder="alamat">
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Kode Pos</label>
			<div class="controls" >
				<input required name="kode_posTB" id="kode_posTB" type="number" maxlength="5" min="10000" max="99999" placeholder="kode pos">
			</div>
			<span style="color:red;"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Jumlah Donasi</label>
			<div class="controls" >
				<input required name="nom_awalTB" id="nom_awalTB"type="number" maxlength="12"  max="999999999999" min="10000" placeholder="jumlah donasi">
			</div>
			<span style="color:red;"></span>
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
			<td><select  class="span1" name="tipeTS" id="tipeTS">
					<option value="">Semua</option>
					<option value="kantor">Kantor</option>
					<option value="rumah">Rumah</option>
				</select>
			</td>
			<td><input class="span1" placeholder="kantor" name="pre_malamatTS" id="pre_malamatTS"></td>
			<td><input class="span2" placeholder="alamat" name="malamatTS" id="malamatTS"></td>
			<td><input class="span1" placeholder="kecamatan" name="mkecamatanTS" id="mkecamatanTS"></td>
			<td><input class="span1" placeholder="kota" name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="propinsi" name="mpropinsiTS" id="mpropinsiTS"></td>
			<td>
				<select class="span1" name="tgl_ambilTS" id="tgl_ambilTS">
					<option value="">semua</option>	
					<option value="1-10">1 s/d 10</option>	
					<option value="11-20">11 s/d 20</option>	
					<option value="21-30">21 s/d 30</option>	
				</select>
			</td>
			<td><input class="span1" placeholder="Nominal" name="nom_awalTS" id="nom_awalTS"></td>
			<!-- <td><input class="span1" placeholder="Petugas" name="namaTS" id="namaTS"></td> -->
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Tempat</b></td>
			<td><b>Kantor</b></td>
			<td><b>Alamat</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kota</b></td>
			<td><b>Propinsi</b></td>
			<td><b>Tgl Tagih</b></td>
			<td><b>nominal</b></td>
			<!-- <td><b>Petugas</b></td> -->
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
