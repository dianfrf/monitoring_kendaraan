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
                    <i class="fas fa-plus"></i> Tambah Atasan / Penyetuju
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($count > 0) {
                            $no = 0;
                            foreach ($atasan as $a) { $no++;
                        ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$a->nama;?></td>
                                <td><?=$a->username;?></td>
                                <td>
                                    <a onclick="Edit(<?=$a->id_user?>);">
                                        <button type="button" name="button" class="btn btn-success" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="<?=base_url()?>User/hapus_atasan/<?=$a->id_user?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
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
                            <td colspan="4" style="text-align:center">Data tidak ditemukan.</td>
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Atasan / Penyetuju</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?=base_url('User/tambah_atasan')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Nama" name="nama" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" min="0">
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Atasan / Penyetuju</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?=base_url('User/edit_atasan')?>" method="post">
            <div class="modal-body">
                <input type="hidden" name="id_user" id="id_user">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" autocomplete="off" min="0">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off" min="0">
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
            url   : '<?=base_url('User/get_atasan_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#id_user').val(data.id_user);
                $('#nama').val(data.nama);
				$('#username').val(data.username);
            }
        });
    }
</script>