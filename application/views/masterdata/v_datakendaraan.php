<section class="section">
	<div class="section-header">
		<h1><?=$PageTitle;?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) { ?>
			<?php echo $this->session->flashdata('pesan');?>
		<?php } ?>
        <div class="card">
            <div class="card-header">
                <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus"></i> Tambah Kendaraan
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kendaraan</th>
                                <th scope="col">No. Polisi</th>
                                <th scope="col">Jenis Kendaraan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($count > 0) {
                            $no = 0;
                            foreach ($kendaraan as $k) { $no++;
                        ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$k->nama_kendaraan;?></td>
                                <td><?=$k->no_pol;?></td>
                                <td>
                                    <?php if($k->jenis_kendaraan == '1') { ?>    
                                    Angkutan Orang
                                    <?php } else { ?>
                                    Angkutan Barang
                                    <?php } ?></td>
                                <td>
                                    <a onclick="Edit(<?=$k->id_kendaraan?>);">
                                        <button type="button" name="button" class="btn btn-success" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="<?=base_url()?>Kendaraan/hapus_kendaraan/<?=$k->id_kendaraan?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
                                        <button type="button" name="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="5" style="text-align:center">Data tidak ditemukan.</td>
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
