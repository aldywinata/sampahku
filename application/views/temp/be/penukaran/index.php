<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title ?></h5>

                        <!-- <form action="<?= base_url('imadmin/setor/') ?>vadd" method="post">
                            <button type="submit" class="btn btn-primary mb-2"><i class="bi bi-plus-circle"></i> Tambah</button>
                        </form> -->

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-danger active" id="konfirmasi-tab" data-bs-toggle="tab" data-bs-target="#bordered-konfirmasi" type="button" role="tab" aria-controls="konfirmasi" aria-selected="true">Konfirmasi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-success" id="completed-tab" data-bs-toggle="tab" data-bs-target="#bordered-completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Riwayat</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-konfirmasi" role="tabpanel" aria-labelledby="konfirmasi-tab">
                                <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">

                                    <div class="dataTable-container">
                                        <table class="table datatable dataTable-table" style="font-size: 15px;" id="dataTables">
                                            <thead style="background-color: #F6F6FE;">
                                                <tr>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class=" disable">No</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Kode</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Tanggal</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Penerima</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Jenis Penukaran</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Total Poin</a>
                                                    </th>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class="">Status</a>
                                                    </th>
                                                    <th class="text-center" scope="col" data-sortable style="width: 160px;">
                                                        <a href="#" class="">Aksi</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($penukarans as $rows) : ?>
                                                    <?php if ($rows['status_penukaran'] == 'proses') : ?>
                                                        <tr>
                                                            <th scope="row" class="text-center"><?= $no++ ?></th>
                                                            <td><a href="" class="" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_penukaran'] ?>"> <?= $rows['id_penukaran'] ?></a></td>
                                                            <td><?= date('d-m-Y H:i:s', $rows['date_penukaran']) ?></td>
                                                            <td><?= ucwords($rows['nama_nasabah']) ?></td>
                                                            <td><?= ucwords($rows['jenis_penukaran']) ?></td>
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
                                                            <td class="text-center">
                                                                <!-- <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_setor'] ?>"><i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a> -->
                                                                <!-- <a href="<?= base_url('imadmin/penukaran/') ?>konfirmasi/<?= $rows['id_penukaran'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Konfirmasi"><i class=" bi bi-check2-circle"></i></a> -->
                                                                <a href="#" class="btn btn-primary btn-konfirmasi" data-id-penukaran="<?= $rows['id_penukaran'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Konfirmasi"><i class=" bi bi-check2-circle"></i></a>
                                                                <a href="https://api.whatsapp.com/send?phone=62<?= $rows['no_tlp_nsb'] ?>&text=Permisi%20kak.%20Kami%20dari%20<?= ucwords($info['nama_sysfo']) ?>%20ingin%20mengkonfirmasi%20mengenai%20Penukaran%20yang%20kamu%20lakukan" target="_BLANK" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hubungi"><i class="bi bi-whatsapp"></i></a>
                                                                <a href="<?= base_url('imadmin/penukaran/') ?>delete/<?= $rows['id_penukaran'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bordered-completed" role="tabpanel" aria-labelledby="completed-tab">
                                <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">

                                    <div class="dataTable-container">
                                        <table class="table datatable dataTable-table" style="font-size: 15px;" id="dataTables2">
                                            <thead style="background-color: #F6F6FE;">
                                                <tr>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class=" disable">No</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Kode</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Tanggal</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Penerima</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Jenis Penukaran</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Total Poin</a>
                                                    </th>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class="">Status</a>
                                                    </th>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class="">Aksi</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($penukarans as $rows) : ?>
                                                    <?php if ($rows['status_penukaran'] != 'proses') : ?>
                                                        <tr>
                                                            <th scope="row" class="text-center"><?= $no++ ?></th>
                                                            <td><a href="" class="" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_penukaran'] ?>"> <?= $rows['id_penukaran'] ?></a></td>
                                                            <td><?= date('d-m-Y H:i:s', $rows['date_penukaran']) ?></td>
                                                            <td><?= ucwords($rows['nama_nasabah']) ?></td>
                                                            <td><?= ucwords($rows['jenis_penukaran']) ?></td>
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
                                                            <td class="text-center">
                                                                <!-- <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_setor'] ?>"><i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a> -->
                                                                <!-- <a href="<?= base_url('imadmin/penukaran/') ?>konfirmasi/<?= $rows['id_penukaran'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Konfirmasi"><i class=" bi bi-check2-circle"></i></a> -->
                                                                <a href="<?= base_url('imadmin/penukaran/') ?>delete/<?= $rows['id_penukaran'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php foreach ($penukarans as $row) : ?>
    <div class="modal fade" id="modalView<?= $row['id_penukaran'] ?>" tabindex="-1">
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
                                <div class="col-lg-4" style="color: #697fa8;">Poin ditukar</div>
                                <div class="col-lg-8"><?= number_format($row['poin_penukaran']) ?> Poin</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Penerima</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_nasabah']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Jenis Penukaran</div>
                                <div class="col-lg-8"><?= ucwords($row['jenis_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Penukaran</div>
                                <div class="col-lg-8"><?= ucwords($row['deskripsi_penukaran']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Tujuan</div>
                                <div class="col-lg-8"><?= $row['send_tujuan'] ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4" style="color: #697fa8;">Harga</div>
                                <div class="col-lg-8">Rp. <?= number_format($row['nominal_penukaran']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>