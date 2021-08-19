<section class="section">
	<div class="section-header">
		<h1><?=$PageTitle;?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) { ?>
			<?php echo $this->session->flashdata('pesan');?>
		<?php } ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kendaraan</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Waktu Pemesanan</th>
                                <th scope="col">Lama Pemesanan</th>
                                <th scope="col">Nama Driver</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($count > 0) {
                            $no = 0;
                            foreach ($pemesanan as $p) { $no++;
                        ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$p->nama_kendaraan;?></td>
                                <td><?=$p->tgl_pemesanan;?></td>
                                <td><?=$p->waktu_pemesanan;?></td>
                                <td><?=$p->lama_pemesanan;?> Jam</td>
                                <td><?=$p->nama_driver;?></td>
                                <td>
                                    <?php if($p->verifikasi == 0 || $p->verifikasi == 1) { ?>
                                    <?php if($p->verifikasi == 1) { ?>
                                    Disetujui    
                                    <?php } elseif($p->verifikasi == 0) { ?>
                                    Ditolak 
                                    <?php } } else {?>
									<form class="form-horizontal" action="<?=base_url()?>Monitoring/verifikasi/<?=$p->id_pemesanan?>" method="post">
										<input type="submit" name="yes" value="Setuju" class="btn btn-primary btn-sm btn-rounded">
										<input type="submit" name="no" value="Tolak" class="btn btn-danger btn-sm btn-rounded">
									</form>
                                    <?php } ?>
								</td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" style="text-align:center">Data tidak ditemukan.</td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</section>
<!-- AddModal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?=base_url('Kendaraan/tambah_kendaraan')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" class="form-control" placeholder="Nama Kendaraan" name="nama_kendaraan" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Nomor Polisi</label>
                    <input type="text" class="form-control" placeholder="Nomor Polisi" name="no_pol" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class=" icon-bulb"></i></div>
                        <select class="selectpicker form-control" data-style="form-control btn-default" name="jenis_kendaraan">
                            <option value="" disabled selected>--Choose--</option>
                            <option value="1">Angkutan Orang</option>
                            <option value="2">Angkutan Barang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Tambah Data" name="add">
            </div>
        </form>
        </div>
    </div>
</div>
<!-- EditModal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Kendaraan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?=base_url('Kendaraan/edit_kendaraan')?>" method="post">
            <div class="modal-body">
                <input type="hidden" name="id_kendaraan" id="id_kendaraan">
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" class="form-control" placeholder="Nama Kendaraan" name="nama_kendaraan" id="nama_kendaraan" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Nomor Polisi</label>
                    <input type="text" class="form-control" placeholder="Nomor Polisi" name="no_pol" id="no_pol" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class=" icon-bulb"></i></div>
                        <select class="selectpicker form-control" data-style="form-control btn-default" name="jenis_kendaraan" id="jenis_kendaraan">
                            <option value="" disabled selected>--Choose--</option>
                            <option value="1">Angkutan Orang</option>
                            <option value="2">Angkutan Barang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Edit Data" name="edit">
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    function Edit(id){
        $('#editModal').modal('show');
        $.ajax({
            type  : 'GET',
            url   : '<?=base_url('Kendaraan/get_kendaraan_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#id_kendaraan').val(data.id_kendaraan);
                $('#nama_kendaraan').val(data.nama_kendaraan);
				$('#jenis_kendaraan').val(data.jenis_kendaraan).change();
				$('#no_pol').val(data.no_pol);
            }
        });
    }
</script>
