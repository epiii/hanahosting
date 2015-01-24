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
<script src="client/s_mpenerima.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR PENERIMA</div></h3>
<!-- <ol class="breadcrumb">
  <li><a href="aturan">Kecamatan / </a></li>
  <li class="active">Penerima / </li>
  <li><a href="jabatan">Jenjang</a></li>
</ol>
 -->
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
		<legend>Data Penerima</legend>		
		<div class="control-group">
			<label class="control-label">Nama Lengkap</label>
			<div class="controls" >
				<input name="namalTB" id="namalTB" required placeholder="Nama Lengkap">
			</div>
			<span id="namalInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Panggilan</label>
			<div class="controls" >
				<input name="namapTB" id="namapTB" required placeholder="Nama Panggilan">
			</div>
			<span id="namapInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Anak Ke</label>
			<div class="controls" >
				<input name="anakTB" id="anakTB" required placeholder="Anak Ke">
			</div>
			<span id="anakInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Jumlah Saudara</label>
			<div class="controls" >
				<input name="sdrTB" id="sdrTB" required placeholder="Jumlah Saudara">
			</div>
			<span id="sdrInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Jenis Kelamin</label>
			<div class="controls" >
				<select name="jenisTB" id="jenisTB" required>
					<option value=''>Jenis Kelamin</option>
					<option value='L'>L</option>
					<option value='P'>P</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Tempat Lahir</label>
			<div class="controls" >
				<input name="tempatTB" id="tempatTB" required placeholder="Tempat Lahir">
			</div>
			<span id="tempatInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Lahir</label>
			<div class="controls" >
				<input name="tanggalTB" id="tanggalTB" required placeholder="dd/mm/yyyy">
			</div>
			<span id="tanggalInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat</label>
			<div class="controls" >
				<input name="alamatTB" id="alamatTB" required placeholder="Alamat">
			</div>
			<span id="alamatInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecamatanTB" id="id_mkecamatanTB" required>
					<option value=''>Pilih Kecamatan ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Agama</label>
			<div class="controls" >
				<input name="agamaTB" id="agamaTB" required placeholder="Agama">
			</div>
			<span id="agamaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">No Telpon</label>
			<div class="controls" >
				<input name="notelTB" id="notelTB" required placeholder="No Telpon">
			</div>
			<span id="notelInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls" >
				<input name="emailTB" id="emailTB" required placeholder="Email">
			</div>
			<span id="emailInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Asrama</label>
			<div class="controls" >
				<select name="asramaTB" id="asramaTB" required>
					<option value=''>Asrama</option>
					<option value='y'>Y</option>
					<option value='n'>N</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status Sosial</label>
			<div class="controls" >
				<select name="statusTB" id="statusTB" required>
					<option value=''>Status Sosial</option>
					<option value='yatim'>Yatim</option>
					<option value='yatim piatu'>Yatim Piatu</option>
					<option value='fakir miskin'>Fakir Miskin</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Active</label>
			<div class="controls" >
				<select name="aktifTB" id="aktifTB" required>
					<option value=''>Active</option>
					<option value='y'>Y</option>
					<option value='n'>N</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<legend>Data Orangtua/Wali</legend>		
		<div class="control-group">
			<label class="control-label">Nama Ayah</label>
			<div class="controls" >
				<input name="namaaTB" id="namaaTB" required placeholder="Nama Ayah">
			</div>
			<span id="namaaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Pekerjaan Ayah</label>
			<div class="controls" >
				<input name="jobaTB" id="jobaTB" required placeholder="Pekerjaan Ayah">
			</div>
			<span id="jobaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gaji Ayah</label>
			<div class="controls" >
				<input name="gajiaTB" id="gajiaTB" required placeholder="Gaji Ayah">
			</div>
			<span id="gajiaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status Ayah</label>
			<div class="controls" >
				<select name="stsaTB" id="stsaTB" required>
					<option value=''>Status Ayah</option>
					<option value='ada'>Ada</option>
					<option value='tidak ada'>Tidak Ada</option>
				</select>
			</div>
			<span id="stsaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Ibu</label>
			<div class="controls" >
				<input name="namaiTB" id="namaiTB" required placeholder="Nama Ibu">
			</div>
			<span id="namaiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Pekerjaan Ibu</label>
			<div class="controls" >
				<input name="jobiTB" id="jobiTB" required placeholder="Pekerjaan Ibu">
			</div>
			<span id="jobiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gaji Ibu</label>
			<div class="controls" >
				<input name="gajiiTB" id="gajiiTB" required placeholder="Gaji Ibu">
			</div>
			<span id="gajiiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status Ibu</label>
			<div class="controls" >
				<select name="stsiTB" id="stsiTB" required>
					<option value=''>Status Ibu</option>
					<option value='ada'>Ada</option>
					<option value='tidak ada'>Tidak Ada</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat Orangtua</label>
			<div class="controls" >
				<input name="alamatotTB" id="alamatotTB" required placeholder="Alamat Orangtua">
			</div>
			<span id="alamatotInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Wali</label>
			<div class="controls" >
				<input name="namawTB" id="namawTB" required placeholder="Nama Wali">
			</div>
			<span id="namawInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Pekerjaan Wali</label>
			<div class="controls" >
				<input name="jobwTB" id="jobwTB" required placeholder="Pekerjaan Wali">
			</div>
			<span id="jobwInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gaji Wali</label>
			<div class="controls" >
				<input name="gajiwTB" id="gajiwTB" required placeholder="Gaji Wali">
			</div>
			<span id="gajiwInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat Wali</label>
			<div class="controls" >
				<input name="alamatwTB" id="alamatwTB" required placeholder="Alamat Wali">
			</div>
			<span id="alamatwInfo"></span>
		</div>
		<button  id="simpanBC"class="btn btn-primary">Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div class="span8"id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama Lengkap</b></td>
			<td><b>Nama Panggilan</b></td>
			<td><b>anak Ke</b></td>
			<td><b>Jumlah Saudara</b></td>
			<td><b>Jenis Kelamin</b></td>
			<td><b>Tempat Lahir</b></td>
			<td><b>Tanggal Lahir</b></td>
			<td><b>Alamat</b></td>
			<td><b>Agama</b></td>
			<td><b>No Telpon</b></td>
			<td><b>Email</b></td>
			<td><b>Asrama</b></td>
			<td><b>Status Sosial</b></td>
			<td><b>Active</b></td>			
			<td colspan="2"><b>Action</b></td>
		</tr>

		<tbody id="isi">

		</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
