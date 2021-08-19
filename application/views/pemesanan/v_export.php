<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$PageTitle.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
 ?>
<table border="1" width="100%">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Pemesanan</th>
            <th scope="col">Nama Kendaraan</th>
            <th scope="col">Tanggal Pemesanan</th>
            <th scope="col">Waktu Pemesanan</th>
            <th scope="col">Durasi Pemesanan</th>
            <th scope="col">Nama Driver</th>
            <th scope="col">Atasan / Penyetuju</th>
        </tr>
    </thead>
    <tbody>
    <?php  $no = 0; foreach ($histori as $h) { $no++; ?>
        <tr>
            <td><?=$no;?></td>
            <td><?=$h->id_pemesanan;?></td>
            <td><?=$h->nama_kendaraan;?></td>
            <td><?=$h->tgl_pemesanan;?></td>
            <td><?=$h->waktu_pemesanan;?></td>
            <td><?=$h->lama_pemesanan;?> jam</td>
            <td><?=$h->nama_driver;?></td>
            <td><?=$h->nama;?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>