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
<script src="client/s_tdonasi.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR DONASI</div></h3>
<!-- <ol class="breadcrumb">
  <li class="active">Sub Unsur 7 /</li>
  <li ><a href="subunsur"> Sub Unsur </a>/</li>
  <li> <a href="unsur">Unsur</a></li>
</ol>
 -->
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- <a href="unsur"id="jabBC" class="btn btn-secondary">unsur <i class='icon-arrow-right'> </i></a> -->
</div>
	


<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<div class="control-group">
			<label class="control-label">Sub Unsur3</label>
			<div class="controls" >
				<select name="id_msubunsur6TB" id="id_msubunsur6TB" required>
					<option value=''>pilih subunsur3 ...</option>
				</select>
			</div>
			<span id="subunsurInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Sub Unsur4</label>
			<div class="controls" >
				<input name="msubunsur7TB" id="msubunsur7TB" requiredx placeholder="Sub Unsur 4">
			</div>
			<span id="subunsurInfo2"></span>
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
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama </b></td>
			<td><b>Donasi</b></td>
			<td><b>Tanggal</b></td>
			<td colspan="2"><b>Aksi</b>
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
