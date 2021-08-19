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
                <a href="<?=base_url('ExportFile')?>">
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-download"></i> Export Ke Excel
                    </button>
                </a>
            </div>  
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Pemesanan</th>
                                <th scope="col">Nama Kendaraan</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Nama Driver</th>
                                <th scope="col">Atasan / Penyetuju</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($count > 0) {
                            $no = 0;
                            foreach ($histori as $h) { $no++;
                        ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$h->id_pemesanan;?></td>
                                <td><?=$h->nama_kendaraan;?></td>
                                <td><?=$h->tgl_pemesanan;?></td>
                                <td><?=$h->nama_driver;?></td>
                                <td><?=$h->nama;?></td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="6" style="text-align:center">Data tidak ditemukan.</td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</section>