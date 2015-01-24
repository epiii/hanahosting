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

<script src="client/s_tdonrutin.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>LAPORAN DONASI RUTIN</div></h3>
<ol class="breadcrumb">
  <li class="active">Donasi Rutin </a> / </li>
  <li><a href="donasi-insidentil">Donasi Sukarela</a></li>
</ol>

<div>
	Tahun : 
	<select class="span1"name="tahunTS" id="tahunTS">
		<option value="">Semua</option>
	</select>
	Bulan : 
	<select class="span1"name="bulanTS" id="bulanTS">
		<option value ="">Semua</option>
		<!-- <option value ="1">Januari</option>
		<option value ="2">Februari</option>
		<option value ="3">Maret</option>
		<option value ="4">April</option>
		<option value ="5">Mei</option>
		<option value ="6">Juni</option>
		<option value ="7">Juli</option>
		<option value ="8">Agustus</option>
		<option value ="9">September</option>
		<option value ="10">Oktober</option>
		<option value ="11">November</option>
		<option value ="12">Desember</option> -->
	</select>&nbsp;
	<!-- cetak report (pdf) -->
	<input type="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesi']; ?>" id="idsesiH">
	<input type="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginy']; ?>" id="id_mloginH">
	<button id="cetakBC" class="btn btn-default"><i class="icon-print"></i> cetak</button>
	<!-- cetak report (pdf) -->
</div>

<divX id="loadtabel"></divX>

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input placeholder="donatur" name="namaTS" id="namaTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Donatur</b></td>
			<td><b class="pull-right">Donasi</b></td>
		</tr>

		<tbody id="isi">

		</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
