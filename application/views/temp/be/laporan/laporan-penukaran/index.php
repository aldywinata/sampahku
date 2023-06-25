<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('nasabah/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filter Tanggal</h5>

                        <form action="<?= base_url('imadmin/laporan_penukaran/index') ?>" method="GET">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="startdate">
                                <span class="input-group-text">s/d</span>
                                <input type="date" class="form-control" name="enddate">
                            </div>

                            <button type="submit" name="tampil" class="btn btn-primary mb-2"><i class="bi bi-search"></i> Tampil</button>
                        </form>
                        <?php if (isset($_GET['tampil'])) : ?>
                            <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">
                                <a href="<?= $url_print ?>"><button type="button" class="btn btn-outline-success mt-4 "><i class="bi bi-printer"></i> Print</button></a>
                                <p class="text-center card-title" style="font-size: 20px;">Laporan Penukaran Poin</p>
                                <div class="dataTable-container">
                                    <label>Periode : <?php echo $label ?></label>
                                    <table class="table datatable dataTable-table mt-2" style="font-size: 14px;">
                                        <thead style="background-color: #F6F6FE;">
                                            <tr>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class=" disable">No</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">ID </a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Tanggal</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Penerima</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Jenis</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Tujuan</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Penukaran</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable style="width: 120px;">
                                                    <a href="#" class="">Harga</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Poin ditukar</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Status</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>