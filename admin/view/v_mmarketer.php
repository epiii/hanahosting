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

<script src="client/s_mmarketer.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR MARKETER</div></h3>
<ol class="breadcrumb">
  <li><a href="admin">Administrator</a> /</li>
  <li class="active">Marketer</li>
</ol>

<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>

<!--panel 1-->
<div id="i_kegPN" style="display:none;"><br>
	<div >
		<form autocomplete="off" method="post" id="form1" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<input type="hidden" id="id_mloginH" name="id_mloginH"/>
	
		<legend>Bio Data</legend>
		<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls" >
				<input type="email" name="emailTB" id="emailTB" placeholder="email" required>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Password</label>
			<div class="controls" >
				<input type="password" name="passwordTB" id="passwordTB" placeholder="password" required>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Nama</label>
			<div class="controls" >
				<input name="namaTB" id="namaTB" required placeholder="Nama">
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">No Telp</label>
			<div class="controls" >
				<input type="number" name="no_telpTB" id="no_telpTB" required placeholder="No Telp">
			</div>
			<span id="mmarketer1"></span>
		</div>

		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input placeholder="Nama" name="namaTS" id="namaTS"></td>
			<td><input placeholder="No Telp" name="no_telpTS" id="no_telpTS"></td>
			<td><input placeholder="email" name="emailTS" id="emailTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama</b></td>
			<td><b>No Telp</b></td>
			<td><b>Email</b></td>
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


<div id="popMe" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="popHeader" align="center">Lokasi Penagihan</h3>
    </div>

	<div class="modal-body">
		<div id="popMeDV">
			<input type="hidden" id="id_mmarketerH" name="id_mmarketerH">
			<button id="addBC2" class="btn btn-default" onclick="tmbhlokasi();"><i class="icon-plus"></i></button> 
			<!-- <form id="lokasiFR" onsubmit="simpanlokasi(this);"> -->
				<table class="table table-striped" width="100%" border="0">
					<thead>
						<tr class="info">
							<th><b>No.</b></th>
							<th><b>Propinsi</b></th>
							<th><b>Kota</b></th>
							<th><b>Kecamatan</b></th>
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
