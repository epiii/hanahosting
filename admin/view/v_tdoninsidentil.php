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

<script src="client/s_tdoninsidentil.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR DONASI SUKARELA</div></h3>
<ol class="breadcrumb">
  <li><a href="donasi-rutin">Donasi Rutin</a> / </li>
  <li class="active">Donasi Sukarela </a></li>
</ol>

<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	Tahun : 
	<select class="span1"name="tahunTS" id="tahunTS">
		<option value="">Semua</option>
	</select>
	Bulan : 
	<select class="span1"name="bulanTS" id="bulanTS">
		<option value ="">Semua</option>
	</select>&nbsp;
	<!-- cetak report (pdf) -->
	<input type="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesi']; ?>" id="idsesiH">
	<input type="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginy']; ?>" id="id_mloginH">
	<button id="cetakBC" class="btn btn-default"><i class="icon-print"></i> cetak</button>
	<!-- cetak report (pdf) -->
	<h3  class="pull-right">Total Dana Terkumpul : <span id="inTotalSP" style="color:blue;"></span></h3>
</div>

<!--panel 1-->
<div Xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div Xclass="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<input type="hidden" id="id_ddonaturH" name="id_ddonaturH"/>
		
		<legend>Data Penagihan Donasi</legend>
		<div class="control-group">
			<label class="control-label">Bank (Rekening)</label>
			<div class="controls" >
				<select name="id_dkatdonaturTB" id="id_dkatdonaturTB" required >
					<option value="">pilih Bank ...</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Donasi</label>
			<div class="controls" >
				<input type="text" min="1000" placeholder="jumlah donasi" name="nom_akhirTB" id="nom_akhirTB" required >
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div id="buktiDV" style="display:none;" class="control-group">
			<label class="control-label">Bukti Transfer (struk::Bank)</label>
			<div class="controls" >
				<a id="buktiA">
					<img id="buktiTB" xsrc="../upload/bukti/siip.png" name="buktiTB" class="vwimg" />
				</a>
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Approve</label>
			<div class="controls" >
				<label>
					<input type="checkbox" value="y" name="isLunasTB" id="isLunasTB">
				</label>
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

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span2" placeholder="Donatur" name="Nama" id="namaTS"></td>
			<td><input class="span1" placeholder="Bank" name="dtipebayarTS" id="dtipebayarTS"></td>
			<td><input class="span2" type="text" placeholder="no. rek" name="no_rekTS" id="no_rekTS"></td>
			<td><input  class="span2" type="text" min="1000" placeholder="donasi" name="nom_akhirTS" id="nom_akhirTS"></td>
			<td></td>
			<td>
				<select class="span1" name="isLunasTS" id="isLunasTS">
					<option value="">Semua</option>	
					<option value="y">Sudah Diperiksa</option>	
					<option value="o">Pending</option>	
				</select>
			</td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama</b></td>
			<td><b>Bank Tujuan</b></td>
			<td><b>No.Rekening Tujuan</b></td>
			<td><b>Donasi</b></td>
			<td><b>tgl Konfirmasi</b></td>
			<td><b>Status</b></td>
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

<div id="popMe" align="center" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="popHeader" align="center"></h3>
    </div>

	<div class="modal-body">
		<div id="popMeDV">
			
		</div>
	</div>

    <div id="popFooter" class="modal-footer">
        <!-- <a href="#" class="btn">Tutup</a> -->
    </div>

</div>
