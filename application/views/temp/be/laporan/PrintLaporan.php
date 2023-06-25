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
            <th>Nasabah</th>
            <th>Jenis Sampah</th>
            <th>Poin</th>
            <th>Berat</th>
            <th>Total Poin</th>
            <th>Status</th>
        </tr>

        <?php if (empty($setors)) : ?>
            <tr>
                <td colspan="9" class="text-center text-danger"><?= "Tidak Ada Data" ?></td>
            </tr>
        <?php else : ?>
            <?php $no = 1;
            foreach ($setors as $rows) : ?>
                <?php
                $poin[] = $rows['poin_sampah_setor'];
                $berat[] = $rows['berat_setor'];
                $potal[] = $rows['poin_total'];
                $jumPoin = array_sum($poin);
                $jumBerat = array_sum($berat);
                $jumPotal = array_sum($potal);
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $rows['id_setor'] ?></td>
                    <td><?= date('d-m-Y H:i:s', $rows['date_setor']) ?></td>
                    <td><?= ucwords($rows['nama_nasabah']) ?></td>
                    <td><?= ucwords($rows['nama_sampah_setor']) ?></td>
                    <td><?= number_format($rows['poin_sampah_setor']) ?></td>
                    <td><?= number_format($rows['berat_setor'], 2, '.', '') ?></td>
                    <td><?= number_format($rows['poin_total']) ?></td>
                    <td>
                        <?php if ($rows['status_setor'] == '0') : ?>
                            <?= ucwords('failed') ?>
                        <?php elseif ($rows['status_setor'] == '1') : ?>
                            <?= ucwords('success') ?>
                        <?php elseif ($rows['status_setor'] == '2') : ?>
                            <?= ucwords('pending') ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td></td>
                <td colspan="4" class=" text-center fw-bold">TOTAL</td>
                <td class=" fw-bold"><?= number_format($jumPoin, 0, ",", ".") ?> Poin</td>
                <td class=" fw-bold"><?= number_format($jumBerat, 2, ",", ".") ?> Kg</td>
                <td colspan="2" class="fw-bold"><?= number_format($jumPotal, 0, ",", ".") ?> Poin</td>
            </tr>
        <?php endif ?>
    </table>
</body>

</html>