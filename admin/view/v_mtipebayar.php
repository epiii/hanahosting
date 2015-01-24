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
<script src="client/s_mtipebayar.js"></script>
<!-- <h4><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h4> -->
<h3><div id="loadarea"><i class="icon-th-list"></i>TIPE - TIPE PEMBAYRAN</div></h3>
<ol class="breadcrumb">
  <li class="active">Kategori Tipe Pembayaran /</li>
  <li ><a href="detail-pembayaran">Detail Tipe Pembayaran</a></li>
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
			<label class="control-label">Tipe Bayar</label>
			<div class="controls" >
            	<input type="text" placeholder="isikan master tipe bayar" name="mtipebayarTB" id="mtipebayarTB" required />
			</div>
			<span id="golInfo"></span>
		</div>
		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div class="span8"id="v_kegPN"></br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
	<tr class="info">
		<td><b>No.</b></td>
		<td><b>Tipe Pembayaran</b></td>
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
