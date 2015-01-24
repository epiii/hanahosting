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

<!-- plugin form-wizard -->
	<!--<link href="../js/plugins/form-wizard/bootstrap-wizard.css" rel="stylesheet" />
	<link href="../js/plugins/form-wizard/chosen/chosen.css" rel="stylesheet" />-->

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
</div>

<!--panel 1-->
<div xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div xclass="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
	
		<legend>Data Penerima</legend>		
		<div class="control-group">
			<label class="control-label">Nama Lengkap</label>
			<div class="controls" >
				<input name="nm_lengkapTB" id="nm_lengkapTB" required placeholder="Nama Lengkap">
			</div>
			<span id="namalInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Panggilan</label>
			<div class="controls" >
				<input name="nm_panggilanTB" id="nm_panggilanTB" required placeholder="Nama Panggilan">
			</div>
			<span id="namapInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Anak Ke</label>
			<div class="controls" >
				<input name="anak_keTB" id="anak_keTB" required placeholder="Anak Ke">
			</div>
			<span id="anakInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Jumlah Saudara</label>
			<div class="controls" >
				<input name="jml_sdrTB" id="jml_sdrTB" required placeholder="Jumlah Saudara">
			</div>
			<span id="sdrInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gender</label>
			<div class="controls" >
				<select name="j_kelaminTB" id="j_kelaminTB" required>
					<option value=''>Pilih Gender ..</option>
					<option value='L'>Laki</option>
					<option value='P'>Perempuan</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Tempat Lahir</label>
			<div class="controls" >
				<input name="tmp_lahirTB" id="tmp_lahirTB" required placeholder="Tempat Lahir">
			</div>
			<span id="tempatInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Lahir</label>
			<div class="controls" >
				<input name="tgl_lahirTB" id="tgl_lahirTB" required placeholder="dd/mm/yyyy">
			</div>
			<span id="tanggalInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat</label>
			<div class="controls" >
				<input name="malamatpTB" id="malamatpTB" required placeholder="Alamat">
			</div>
			<span id="alamatInfo"></span>
		</div>
		<!-- <div class="control-group">
			<label class="control-label">Kode Pos</label>
			<div class="controls" >
				<input name="kode_pospTB" id="kode_pospTB" required placeholder="kode pos">
			</div>
			<span id="alamatInfo"></span>
		</div> -->
		<div class="control-group">
			<label class="control-label">Propinsi</label>
			<div class="controls" >
				<select name="id_mproppTB" id="id_mproppTB" required>
					<option value=''>Pilih propinsi ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kota</label>
			<div class="controls" >
				<select name="id_mkotpTB" id="id_mkotpTB" required>
					<option value=''>Pilih propinsi dahulu  ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecpTB" id="id_mkecpTB" required>
					<option value=''>Pilih pilih kota dahulu ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Agama</label>
			<div class="controls" >
				<select  name="agamaTB" id="agamaTB" required>
					<option value="">Pilih Agama ..</option>
					<option value="Islam">Islam</option>
					<option value="Katholik">Katholik</option>
					<option value="Protestan">Protestan</option>
					<option value="Hindu">Hindu</option>
					<option value="Budha">Budha</option>
					<option value="Konghucu">Konghucu</option>
				</select>
			</div>
			<span id="agamaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">No Telpon</label>
			<div class="controls" >
				<input name="no_telpTB" id="no_telpTB" required placeholder="No Telpon">
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
			<label class="control-label">Bersedia Diasramakan</label>
			<div class="controls" >
				<select name="asramaTB" id="asramaTB" required>
					<option value=''>Pilih Asrama .. </option>
					<option value='y'>Ya</option>
					<option value='n'>Tidak</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status sosial</label>
			<div class="controls" >
				<select name="status_sosTB" id="status_sosTB" required>
					<option value=''>Pilih Status Sosial ..</option>
					<option value='yatim'>Yatim</option>
					<option value='yatim piatu'>Yatim Piatu</option>
					<option value='fakir miskin'>Fakir Miskin</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">status</label>
			<div class="controls" >
				<select name="isActiveTB" id="isActiveTB" required>
					<option value=''>status</option>
					<option value='y'>Aktif</option>
					<option value='n'>Tidak Aktif</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<legend>Data Orang Tua</legend>		
		<div class="control-group">
			<label class="control-label">Nama Ayah</label>
			<div class="controls" >
				<input name="nm_ayahTB" id="nm_ayahTB" required placeholder="Nama Ayah">
			</div>
			<span id="namaaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Pekerjaan Ayah</label>
			<div class="controls" >
				<input name="job_ayahTB" id="job_ayahTB" required placeholder="Pekerjaan Ayah">
			</div>
			<span id="jobaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gaji Ayah</label>
			<div class="controls" >
				<input name="gaji_ayahTB" id="gaji_ayahTB" required placeholder="Gaji Ayah">
			</div>
			<span id="gajiaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status Ayah</label>
			<div class="controls" >
				<select name="stat_ayahTB" id="stat_ayahTB" required>
					<option value=''>Pilih status ayah</option>
					<option value='hidup'>hidup</option>
					<option value='meninggal'>Meninggal</option>
				</select>
			</div>
			<span id="stsaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Ibu</label>
			<div class="controls" >
				<input name="nm_ibuTB" id="nm_ibuTB" required placeholder="Nama Ibu">
			</div>
			<span id="namaiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Pekerjaan Ibu</label>
			<div class="controls" >
				<input name="job_ibuTB" id="job_ibuTB" required placeholder="Pekerjaan Ibu">
			</div>
			<span id="jobiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Gaji Ibu</label>
			<div class="controls" >
				<input name="gaji_ibuTB" id="gaji_ibuTB" required placeholder="Gaji Ibu">
			</div>
			<span id="gajiiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Status Ibu</label>
			<div class="controls" >
				<select name="stat_ibuTB" id="stat_ibuTB" required>
					<option value=''>Pilih Status Ibu ..</option>
					<option value='hidup'>Hidup</option>
					<option value='meninggal'>Meninggal</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat Orang tua</label>
			<div class="controls" >
				<input name="malamatoTB" id="malamatoTB" required placeholder="Alamat Orangtua">
			</div>
			<span id="alamatotInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Propinsi</label>
			<div class="controls" >
				<select name="id_mpropoTB" id="id_mpropoTB" required>
					<option value=''>Pilih propinsi ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kota</label>
			<div class="controls" >
				<select name="id_mkotoTB" id="id_mkotoTB" required>
					<option value=''>Pilih Propinsi dahulu ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecoTB" id="id_mkecoTB" required>
					<option value=''>Pilih Kota dahulu ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		
		<legend>Data Wali (opsional) <input name="tugelTB" value="1" type="checkbox" id="tugelTB"></legend>
		<div class="control-group tugel">
			<label class="control-label">Nama Wali</label>
			<div class="controls" >
				<input name="nm_waliTB" id="nm_waliTB" xrequired placeholder="Nama Wali">
			</div>
			<span id="namawInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Pekerjaan Wali</label>
			<div class="controls" >
				<input name="job_waliTB" id="job_waliTB" xrequired placeholder="Pekerjaan Wali">
			</div>
			<span id="jobwInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Gaji Wali</label>
			<div class="controls" >
				<input name="gaji_waliTB" id="gaji_waliTB" xrequired placeholder="Gaji Wali">
			</div>
			<span id="gajiwInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Alamat Wali</label>
			<div class="controls" >
				<input name="malamatwTB" id="malamatwTB" xrequired placeholder="Alamat Wali">
			</div>
			<span id="alamatwInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Kode Pos</label>
			<div class="controls" >
				<input name="kode_poswTB" id="kode_poswTB" xrequired placeholder="kode pos">
			</div>
			<span id="alamatwInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Propinsi</label>
			<div class="controls" >
				<select name="id_mpropwTB" id="id_mpropwTB" xrequired>
					<option value=''>Pilih propinsi ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Kota</label>
			<div class="controls" >
				<select name="id_mkotwTB" id="id_mkotwTB" xrequired>
					<option value=''>Pilih Propinsi dahulu ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>
		<div class="control-group tugel">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecwTB" id="id_mkecwTB" xrequired>
					<option value=''>Pilih Kota dahulu ...</option>
				</select>
			</div>
			<span id="stsiInfo"></span>
		</div>

		<legend>Prestasi yang diraih</legend>		
			<!-- TABEL PRESTASI -->
			<div class="control-group">
                <a id="prestBC" class="btn btn-secondary">
					<i class="icon-plus"></i> Tambah Prestasi
                </a>
			</div>	
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="info">
						<th>instansi</th>
						<th>kompetisi</th>
						<th>tingkat</th>
						<th>juara</th>
						<th>tahun</th>
						<th>kategori</th>
						<th colspan="2">aksi</th>
					</tr>
				</thead>
				<tbody id="prestTB">
					<!-- isi prestasi -->
				</tbody>
			</table>
            <span class="controls">
				<!-- notif jika tidka terisi -->
                <label id="prestInfo" class="label label-important"></label>
            </span>
	
		<button  id="simpanBC"class="btn btn-primary">Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
	
</div>
<!-- end of panel 1 -->
<divX id="loadtabel"></divX>

<div xclass="span8"id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class ="span1" placeholder="Nama Lengkap" name="nm_lengkapTS" id="nm_lengkapTS"></td>
			<td><input class ="span1" placeholder="Nama Panggilan" name="nm_panggilanTS" id="nm_panggilanTS"></td>
			<td><input class ="span1" placeholder="Anak ke" name="anak_keTS" id="anak_keTS"></td>
			<td><input class ="span1" placeholder="Jumlah Saudara" name="jml_sdrTS" id="jml_sdrTS"></td>
			<td><input class ="span1" placeholder="Jenis Kelamin" name="j_kelaminTS" id="j_kelaminTS"></td>
			<td><input class ="span1" placeholder="Tempat Lahir" name="tmp_lahirTS" id="tmp_lahirTS"></td>
			<td><input class ="span1" placeholder="Tanggal Lahir" name="tgl_lahirTS" id="tgl_lahirTS"></td>
			<td><input class ="span1" placeholder="Alamat" name="alamatpTS" id="alamatpTS"></td>
			<td><input class ="span1" placeholder="Agama" name="agamaTS" id="agamaTS"></td>
			<td><input class ="span1" placeholder="No Telpon" name="no_telpTS" id="no_telpTS"></td>
			<td><input class ="span1" placeholder="Email" name="emailTS" id="emailTS"></td>
			<td><input class ="span1" placeholder="Asrama" name="asramaTS" id="asramaTS"></td>
			<td><input class ="span1" placeholder="Status Sosial" name="status_sosTS" id="status_sosTS"></td>
			<td><input class ="span1" placeholder="Active" name="isActiveTS" id="isActiveTS"></td>
			<td></td>
		</tr>

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



<div id="popMe" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="popHeader" align="center">Detail Data Sekolah</h3>
    </div>

	<div class="modal-body">
		<div id="popMeDV">
			<!-- <form id="lokasiFR" > -->
				<input type="hidden" id="id_mpenerimaH" name="id_mpenerimaH">
				<button id="addBC2" class="btn btn-default" onclick="tmbhsekolah();"><i class="icon-plus"></i></button> 
					<table class="table table-striped" width="100%" border="0">
						<thead>
							<tr class="info">
								<th><b>No.</b></th>
								<th><b>Sekolah</b></th>
								<th><b>Yayasan</b></th>
								<th><b>Koord. Yayasan</b></th>
								<th colspan="2"><b>Action</b>
								</th>
							</tr>
						</thead>

						<tbody id="isi2"></tbody>
					</table>
			<!-- </form> -->
		</div>
	</div>

    <div id="popFooter" class="modal-footer">
        <!-- <a href="#" class="btn">Tutup</a> -->
    </div>
</div>