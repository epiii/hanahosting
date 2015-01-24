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
  <li><a href="pengaturan-donasi-rutin">Pengaturan Donasi Rutin</a> /</li>
  <li class="active">Donasi Rutin </a> / </li>
  <li><a href="donasi-insidental">Donasi Sukarela</a></li>
</ol>

<div>
	Tahun : 
	<select class="span1"name="tahunTS" id="tahunTS">
		<option value="">Semua</option>
	</select>
</div>

<divX id="loadtabel"></divX>

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input min="10000" type="number" placeholder="donasi" name="nom_akhirTS" id="nom_akhirTS"></td>
			<td></td>
			<!-- <td><input  placeholder="penagih" name="namaTS" id="namaTS"></td> -->
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Donasi</b></td>
			<td><b>Tanggal </b></td>
			<!-- <td><b>Penagih</b></td> -->
		</tr>

		<tbody id="isi">

		</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
