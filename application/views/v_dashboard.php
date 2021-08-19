<section class="section">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-statistic-2">
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-file-alt"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header"><h4>Total Pemesanan</h4></div>
					<div class="card-body"><?=$tothistori?></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-statistic-2">
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-car"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header"><h4>Total Kendaraan</h4></div>
					<div class="card-body"><?=$totkendaraan?></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-statistic-2">
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-user"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header"><h4>Total Atasan / Penyetuju</h4></div>
					<div class="card-body"><?=$totpenyetuju?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4>Data Pemesanan Kendaraan Perbulan</h4>
				</div>
				<div class="card-body">
					<canvas id="ikiChart"></canvas>
					<?php
						$nama_bulan= "";
						$jumlah=null;
						foreach ($hasil as $item)
						{
							$bulan=$item->bulan;
							if($bulan == 1){$bulan = "Januari";}
							elseif($bulan == 2){$bulan = "Februari";}
							elseif($bulan == 3){$bulan = "Maret";}
							elseif($bulan == 4){$bulan = "April";}
							elseif($bulan == 5){$bulan = "Mei";}
							elseif($bulan == 6){$bulan = "Juni";}
							elseif($bulan == 7){$bulan = "Juli";}
							elseif($bulan == 8){$bulan = "Agustus";}
							elseif($bulan == 9){$bulan = "September";}
							elseif($bulan == 10){$bulan = "Oktober";}
							elseif($bulan == 11){$bulan = "November";}
							else{$bulan = "Desember";}
							$nama_bulan .= "'$bulan'". ", ";
							$jum=$item->jumlah;
							$jumlah .= "$jum". ", ";
						}
					?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4>Grafik Jenis Kendaraan</h4>
				</div>
				<div class="card-body">
					<canvas id="ikiChart2"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4 class="d-inline">Data Kendaraan</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama Kendaraan</th>
									<th scope="col">No. Polisi</th>
								</tr>
							</thead>
							<tbody>
							<?php if ($totkendaraan > 0) {
								$no = 0;
								foreach ($kendaraan as $k) { $no++;
							?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$k->nama_kendaraan;?></td>
									<td><?=$k->no_pol;?></td>
								</tr>
							<?php
								}
							} else {
							?>
							<tr>
								<td colspan="3" style="text-align:center">Data tidak ditemukan.</td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<a href="<?=base_url('Data_Kendaraan')?>"><button class="btn btn-success">More</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4 class="d-inline">Data Atasan / Penyetuju</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama</th>
									<th scope="col">Username</th>
								</tr>
							</thead>
							<tbody>
							<?php if ($totpenyetuju > 0) {
								$no = 0;
								foreach ($atasan as $a) { $no++;
							?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$a->nama;?></td>
									<td><?=$a->username;?></td>
								</tr>
							<?php
								}
							} else {
							?>
							<tr>
								<td colspan="3" style="text-align:center">Data tidak ditemukan.</td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<a href="<?=base_url('Data_Atasan')?>"><button class="btn btn-success">More</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h4 class="d-inline">Histori Pemesanan</h4>
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
					<?php if ($tothistori > 0) {
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
				<a href="<?=base_url('Histori_Pemesanan')?>"><button class="btn btn-success">More</button></a>
			</div>
		</div>
	</div>
</section>
<script src="<?=base_url()?>Asset/modules/chart.min.js"></script>
<script>
    var ctx = document.getElementById('ikiChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $nama_bulan; ?>],
            datasets: [{
                label:'Jumlah Pesanan ',
                backgroundColor: '#6777ef',
      			borderColor: '#6777ef',
                data: [<?php echo $jumlah; ?>]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
						stepSize: 1
                    }
                }]
            }
        }
    });
	var ctx = document.getElementById('ikiChart2').getContext('2d');
	var chart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			datasets: [{
			data: [
				<?php echo $orang; ?>,<?php echo $barang; ?>
			],
			backgroundColor: [
				'#6777ef',
				'#4347cf',
			],
			label: 'Jenis Kendaraan'
			}],
			labels: [
			'Angkutan Barang',
			'Angkutan Orang'
			],
		},
		options: {
			responsive: true,
			legend: {
			position: 'bottom',
			},
		}
	});

</script>