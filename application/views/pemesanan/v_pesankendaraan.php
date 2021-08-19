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
                                <th scope="col">No. Polisi</th>
                                <th scope="col">Status</th>
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
                                    <?php if($k->is_ready == '0') { ?>    
                                    Terpakai
                                    <?php } elseif($k->is_ready == '2') { ?>
                                    Menunggu Konfirmasi
                                    <?php } else { ?>
                                        Ready
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($k->is_ready == '0') { ?>
                                        <form class="form-horizontal" action="<?=base_url()?>Monitoring/inputhistori/<?=$k->id_kendaraan?>" method="post">
                                            <input type="submit" name="selesaikan" value="Selesaikan Pesanan" class="btn btn-success btn-sm btn-rounded">
                                        </form>
                                    <?php } else if($k->is_ready == '2') { ?>    
                                        -
                                    <?php } else { ?>
                                    <a onclick="Pesan(<?=$k->id_kendaraan?>);">
                                        <button type="button" name="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Pesan Kendaraan">
                                            Pesan Kendaraan
                                        </button>
                                    </a>
                                    <?php } ?>
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
<!-- PesanModal -->
<div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pesan Kendaraan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?=base_url('Monitoring/kendaraan_pesan')?>" method="post">
            <div class="modal-body">
                <input type="hidden" name="id_kendaraan" id="id_kendaraan">
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" class="form-control" placeholder="Nama Kendaraan" id="nama_kendaraan" autocomplete="off" min="0" disabled>
                </div>
                <div class="form-group">
                    <label>Tanggal Pemesanan</label>
                    <input type="date" class="form-control" placeholder="Tanggal Pemesanan" name="tgl_pemesanan" autocomplete="off" min="0">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Waktu Pemesanan</label>
                            <input type="time" class="form-control" placeholder="Waktu Pemesanan" name="waktu_pemesanan" autocomplete="off" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Durasi Pemesanan (Jam)</label>
                            <input type="number" class="form-control" placeholder="Durasi Pemesanan (Jam)" name="lama_pemesanan" autocomplete="off" min="1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Driver</label>
                            <input type="text" class="form-control" placeholder="Nama Driver" name="nama_driver" autocomplete="off" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Atasan / Penyetuju</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class=" icon-bulb"></i></div>
                                <select class="selectpicker form-control" data-style="form-control btn-default" name="penyetuju">
                                    <option value="" disabled selected>--Choose--</option>
                                <?php foreach ($penyetuju as $p) { ?>
                                    <option value="<?=$p->id_user?>"><?=$p->nama?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Pesan Kendaraan" name="pesan">
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    function Pesan(id){
        $('#pesanModal').modal('show');
        $.ajax({
            type  : 'GET',
            url   : '<?=base_url('Kendaraan/get_kendaraan_id/')?>'+id,
            dataType : 'json',
            success : function(data){
                $('#id_kendaraan').val(data.id_kendaraan);
                $('#nama_kendaraan').val(data.nama_kendaraan);
            }
        });
    }
</script>