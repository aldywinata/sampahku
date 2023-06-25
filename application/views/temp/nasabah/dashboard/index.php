<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">

                <div class="row">

                    <!-- Carousel Card -->
                    <div class="col-xl-8 col-md-8">
                        <div class="card">

                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($rewards as $row) : ?>
                                        <?php if ($row['on_thumbnail'] == '1' && $row['status_reward'] == '1') : ?>
                                            <div class="carousel-item active">
                                                <a href="<?= base_url() ?>nasabah/penukaran/vtransaksi/<?= $row['kode_reward'] ?>">
                                                    <img src="<?= base_url() ?>assets/imgs/be/img-reward/<?= $row['img_reward'] ?>" class="d-block w-100 carousel-image" alt="...">
                                                </a>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div><!-- End Slides with fade transition -->

                        </div>
                    </div><!-- End Carousel Card -->

                    <!-- Nasabah Card -->
                    <div class="col-xl-4 col-md-2">
                        <div class="row">
                            <div class="col">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Poinku</h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-wallet2"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= number_format($nasabah['poin_nasabah']) ?></h6>
                                                <span class="text-primary small pt-1 fw-bold">Poin</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Akumulasi <span>| Sampah</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-recycle"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= empty($jumBerat) ? 0 : number_format($jumBerat, 2, '.', '') ?></h6>

                                                <span class="text-danger small pt-1 fw-bold">kg</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- End Nasabah Card -->

                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card top-selling overflow-auto">

                            <div class="filter mt-2">
                                <a href="<?= base_url('nasabah/') ?>laporan-setor" class="icon" style="font-size: 13px;">Selengkapnya</a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Riwayat <span>| Setor Sampah</span></h5>

                                <div class="list-group">
                                    <?php if (empty($setors)) : ?>
                                        <p class="text-danger text-center">Tidak Ada Riwayat</p>
                                    <?php else : ?>
                                        <?php foreach ($setors as $row) : ?>
                                            <a href="" class="list-group-item list-group-item-action" aria-current="true" data-bs-toggle="modal" data-bs-target="#modalView<?= $row['id_setor'] ?>">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1 fw-bold" style="font-size: 17px;"><?= ucwords($row['nama_sampah_setor']) ?></h5>
                                                    <small class="text-secondary">ID : <?= $row['id_setor'] ?></small>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <p class="mb-1">Perolehan Poin : <span class="fw-bold"> <?= number_format($row['poin_total']) ?> Poin</span> </p>
                                                    <?php if ($row['status_setor'] == '0') : ?>
                                                        <small><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('failed') ?></span></small>
                                                    <?php elseif ($row['status_setor'] == '1') : ?>
                                                        <small><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('success') ?></span></small>
                                                    <?php elseif ($row['status_setor'] == '2') : ?>
                                                        <small><span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= ucwords('pending') ?></span></small>
                                                    <?php endif ?>
                                                </div>
                                                <small class="text-secondary"><?= date('d-m-Y- H:i:s', $row['date_setor']) ?></small>
                                            </a>
                                        <?php endforeach ?>

                                    <?php endif ?>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card top-selling overflow-auto">

                            <div class="filter mt-2">
                                <a href="<?= base_url('nasabah/') ?>laporan-penukaran" class="icon" style="font-size: 13px;">Selengkapnya</a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Riwayat <span>| Penukaran Poin</span></h5>

                                <div class="list-group">
                                    <?php if (empty($penukaras)) : ?>
                                        <p class="text-danger text-center">Tidak Ada Riwayat</p>
                                    <?php else : ?>
                                        <?php foreach ($penukaras as $row) : ?>
                                            <a href="" class="list-group-item list-group-item-action" aria-current="true" data-bs-toggle="modal" data-bs-target="#modalViewP<?= $row['id_penukaran'] ?>">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1 fw-bold" style="font-size: 17px;"><?= ucwords($row['deskripsi_penukaran']) ?></h5>
                                                    <small class="text-secondary">ID : <?= $row['id_penukaran'] ?></small>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <p class="mb-1">Poin ditukar : <span class="fw-bold"> <?= number_format($row['poin_penukaran']) ?> Poin</span> </p>
                                                    <?php if ($row['status_penukaran'] == 'failed') : ?>
                                                        <small><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                                    <?php elseif ($row['status_penukaran'] == 'completed') : ?>
                                                        <small><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                                    <?php elseif ($row['status_penukaran'] == 'proses') : ?>
                                                        <small><span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                                    <?php endif ?>
                                                </div>
                                                <small class="text-secondary"><?= date('d-m-Y- H:i:s', $row['date_penukaran']) ?></small>
                                            </a>
                                        <?php endforeach ?>

                                    <?php endif ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div><!-- End Left side columns -->

        </div>

    </section>

</main><!-- End #main -->
<?php foreach ($setorss as $row) : ?>
    <div class="modal fade" id="modalView<?= $row['id_setor'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi : <span class="fw-bold"><?= $row['id_setor'] ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">ID Transaksi</div>
                                <div class="col-lg-8"><?= $row['id_setor'] ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Tanggal Transaksi</div>
                                <div class="col-lg-8"><?= date('d-m-Y H:i:s', $row['date_setor']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Nasabah</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_nasabah']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Jenis Sampah</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_sampah_setor']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Poin Sampah</div>
                                <div class="col-lg-8"><?= number_format($row['poin_sampah_setor']) ?> Poin</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Berat Sampah</div>
                                <div class="col-lg-8"><?= number_format($row['berat_setor'], 2, '.', '') ?> Kg</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Total Poin</div>
                                <div class="col-lg-8"><?= number_format($row['poin_total']) ?> Poin</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Status Transaksi</div>
                                <div class="col-lg-8">
                                    <?php if ($row['status_setor'] == '0') : ?>
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('failed') ?></span>
                                    <?php elseif ($row['status_setor'] == '1') : ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('success') ?></span>
                                    <?php elseif ($row['status_setor'] == '2') : ?>
                                        <span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= ucwords('pending') ?></span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Petugas</div>
                                <div class="col-lg-8"><?= ucwords($row['petugas']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php foreach ($penukarass as $row) : ?>
    <div class="modal fade" id="modalViewP<?= $row['id_penukaran'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi : <span class="fw-bold"><?= $row['id_penukaran'] ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">ID Transaksi</div>
                                <div class="col-lg-8"><?= $row['id_penukaran'] ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Tanggal Transaksi</div>
                                <div class="col-lg-8"><?= date('d-m-Y H:i:s', $row['date_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Nama Penerima</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_tujuan']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Jenis Penukaran</div>
                                <div class="col-lg-8"><?= ucwords($row['jenis_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Tujuan</div>
                                <div class="col-lg-8"><?= $row['send_tujuan'] ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Penukaran</div>
                                <div class="col-lg-8"><?= ucwords($row['deskripsi_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Harga</div>
                                <div class="col-lg-8">Rp. <?= number_format($row['nominal_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Poin ditukar</div>
                                <div class="col-lg-8"><?= number_format($row['poin_penukaran']) ?> Poin</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Status Transaksi</div>
                                <div class="col-lg-8">
                                    <?php if ($row['status_penukaran'] == 'failed') : ?>
                                        <small><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                    <?php elseif ($row['status_penukaran'] == 'completed') : ?>
                                        <small><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                    <?php elseif ($row['status_penukaran'] == 'proses') : ?>
                                        <small><span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= strtoupper($row['status_penukaran']) ?></span></small>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>