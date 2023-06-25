<html>

<head>
    <title>Print Laporan Pembayaran</title>
    <style>
        .table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }

        .table th {
            padding: 5px;
        }

        .table .no {
            width: 10px;
        }

        .table td {
            word-wrap: break-word;
            padding: 5px;
        }
    </style>
</head>

<body>
    <center>
        <h3 style="margin-bottom: 5px;">LAPORAN SETOR SAMPAH</h3>
    </center>

    <label>Laporan : <?= $label ?></label>
    <table class="table" border="1" width="100%" style="margin-top: 10px; font-size: 13px;">
        <tr>
            <th class="no">NO</th>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Penerima</th>
            <th>Jenis</th>
            <th>Tujuan</th>
            <th>Penukaran</th>
            <th>Harga</th>
            <th>Poin ditukar</th>
            <th>Status</th>
        </tr>

        <?php if (empty($penukarans)) : ?>
            <tr>
                <td colspan="10" class="text-center text-danger"><?= "Tidak Ada Data" ?></td>
            </tr>
        <?php else : ?>
            <?php $no = 1;
            foreach ($penukarans as $rows) : ?>
                <?php
                $harga[] = $rows['nominal_penukaran'];
                $poin[] = $rows['poin_penukaran'];
                $jumHarga = array_sum($harga);
                $jumPoin = array_sum($poin);
                ?>
                <tr>
                    <th scope="row" class="text-center"><?= $no++ ?></th>
                    <td><?= $rows['id_penukaran'] ?></td>
                    <td><?= date('d-m-Y H:i:s', $rows['date_penukaran']) ?></td>
                    <td><?= ucwords($rows['nama_tujuan']) ?></td>
                    <td><?= ucwords($rows['jenis_penukaran']) ?></td>
                    <td><?= ucwords($rows['send_tujuan']) ?></td>
                    <td><?= ucwords($rows['deskripsi_penukaran']) ?></td>
                    <td>Rp. <?= number_format($rows['nominal_penukaran']) ?></td>
                    <td><?= number_format($rows['poin_penukaran']) ?></td>
                    <td>
                        <?php if ($rows['status_penukaran'] == 'failed') : ?>
                            <small><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= strtoupper($rows['status_penukaran']) ?></span></small>
                        <?php elseif ($rows['status_penukaran'] == 'completed') : ?>
                            <small><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= strtoupper($rows['status_penukaran']) ?></span></small>
                        <?php elseif ($rows['status_penukaran'] == 'proses') : ?>
                            <small><span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= strtoupper($rows['status_penukaran']) ?></span></small>
                        <?php elseif ($rows['status_penukaran'] == 'pending') : ?>
                            <small><span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= strtoupper($rows['status_penukaran']) ?></span></small>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td></td>
                <td colspan="6" class=" text-center fw-bold">TOTAL</td>
                <td class=" fw-bold">Rp. <?= number_format($jumHarga, 0, ",", ".") ?></td>
                <td colspan="2" class="fw-bold"><?= number_format($jumPoin, 0, ",", ".") ?> Poin</td>
            </tr>
        <?php endif ?>
    </table>
</body>

</html>