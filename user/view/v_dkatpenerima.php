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

<script src="client/s_dkatpenerima.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR KATEGORI PENERIMA DONASI </div></h3>
<ol class="breadcrumb">
  <li><a href="kategori-penerima">Kategori penerima donasi / </a></li>
  <li class="active">Detail penerima donasi</li>
</ol>

<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- <a href="jabatan"id="jabBC" class="btn btn-secondary">Jabatan <i class='icon-arrow-right'> </i></a> -->
</div>
	


<!--panel 1-->
<div Xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<div class="control-group">
			<label class="control-label">Kategori Penerima</label>
			<div class="controls" >
				<select name="id_mkatpenerimaTB" id="id_mkatpenerimaTB" required>
					<option value=''>Pilih kategori penerima ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Jenjang</label>
			<div class="controls" >
				<select name="id_mjenjangTB" id="id_mjenjangTB"  required>
					<option value="">pilih jenjang ...</option>
				</select> 
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Nominal</label>
			<div class="controls" >
				<input  name="nominalTB" id="nominalTB"  placeholder="nominal donasi " required>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Status</label>
			<div class="controls" >
				<select name="statusTB" id="statusTB" required>
					<option value="">Pilih status ...</option>
					<option value="aktif">aktif</option>
					<option value="non">non aktif</option>
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

<div Xclass="span8"id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span1" placeholder="kategori penerima" name="katpenerimaTS" id="katpenerimaTS"></td>
			<td><input class="span1" placeholder="jenjang" name="mjenjangTS" id="mjenjangTS"></td>
			<td><input class="span1" placeholder="nominal" name="nominalTS" id="nominalTS"></td>
			<td><input class="span1" placeholder="status" name="statusTS" id="statusTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>kategori penerima</b></td>
			<td><b>jenjang </b></td>
			<td><b>nominal</b></td>
			<td><b>status </b></td>
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
