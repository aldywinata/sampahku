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

                        <form action="<?= base_url('imadmin/setor/') ?>vadd" method="post">
                            <button type="submit" class="btn btn-primary mb-2"><i class="bi bi-plus-circle"></i> Tambah</button>
                        </form>

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
                                                <a href="#" class="">Nama Nasabah</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Jenis Sampah</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Total Poin</a>
                                            </th>
                                            <th class="text-center" scope="col" data-sortable>
                                                <a href="#" class="">Status</a>
                                            </th>
                                            <th class="text-center" scope="col" data-sortable style="width: 100px;">
                                                <a href="#" class="">Aksi</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($setors as $rows) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $no++ ?></th>
                                                <td><a href="" class="" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_setor'] ?>"> <?= $rows['id_setor'] ?></a></td>
                                                <td><?= date('d-m-Y H:i:s', $rows['date_setor']) ?></td>
                                                <td><?= ucwords($rows['nama_nasabah']) ?></td>
                                                <td><?= ucwords($rows['nama_sampah_setor']) ?></td>
                                                <td class="text-end"><?= number_format($rows['poin_total']) ?></td>
                                                <!-- <td class="text-center">
                                                    <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $rows['kode_reward']; ?>', 'imadmin/hadiah/updateStatus')" <?= ($rows['status_reward'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                </td> -->
                                                <td>
                                                    <?php if ($rows['status_setor'] == '0') : ?>
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('failed') ?></span>
                                                    <?php elseif ($rows['status_setor'] == '1') : ?>
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('success') ?></span>
                                                    <?php elseif ($rows['status_setor'] == '2') : ?>
                                                        <span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= ucwords('pending') ?></span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_setor'] ?>"><i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a> -->
                                                    <a href="<?= base_url('imadmin/setor/') ?>vedit/<?= $rows['id_setor'] ?>" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class=" bi bi-pencil-square"></i></a>
                                                    <a href="<?= base_url('imadmin/setor/') ?>delete/<?= $rows['id_setor'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php foreach ($setors as $row) : ?>
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