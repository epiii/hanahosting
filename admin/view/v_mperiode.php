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

<script src="client/s_mperiode.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR PERIODE</div></h3>

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
			<label class="control-label">Tahun</label>
			<div class="controls" >
				<select class="span1"  name="tahunTB" id="tahunTB" required>
					<option value=''>Pilih Tahun ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">semester</label>
			<div class="controls" >
				<select class="span1" name="semesterTB" id="semesterTB" required>
					<option value=''>Pilih semester ...</option>
					<option value='ganjil'>ganjil</option>
					<option value='genap'>genap</option>
				</select>
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
			<td>
				<select name="tahunTS" id="tahunTS">
					<option value="">semua</option>
					<?php
						// $skr=date("Y");
						// for($i=$skr; $i<1990; $i--){
						// 	echo '<option value="'.$i.'">'.$i.'</option>';
						// }
					?>
				</select>
			</td>
			<td>
				<select name="semesterTS" id="semesterTS">
					<option value="">semua</option>
					<option value="ganjil">ganjil</option>
					<option value="genap">genap</option>
				</select>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Tahun</b></td>
			<td><b>Semester</b></td>
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
