<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data <?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data <?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data <?= $title ?></h5>

                        <form action="<?= base_url('imadmin/sampah/') ?>vadd" method="post">
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
                                                <a href="#" class="">Foto</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Kode</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Nama Sampah</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Deskripsi</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Poin</a>
                                            </th>
                                            <th class="text-center" scope="col" data-sortable>
                                                <a href="#" class="">Status</a>
                                            </th>
                                            <th class="text-center" scope="col" data-sortable style="width: 150px;">
                                                <a href="#" class="">Aksi</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($sampahs as $rows) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $no++ ?></th>
                                                <td>
                                                    <img src="<?= base_url('assets/imgs/be/img-sampah/' . $rows['img_sampah']) ?>" class=" img-size rounded" alt="">
                                                </td>
                                                <td><?= strtoupper($rows['kode_sampah_kat']) ?></td>
                                                <td><?= ucwords($rows['nama_sampah']) ?></td>
                                                <td><?= ucwords($rows['deskripsi_sampah']) ?></td>
                                                <td><?= number_format($rows['poin_sampah']) ?></td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $rows['id_sampah']; ?>', 'imadmin/sampah/updateStatus')" <?= ($rows['status_sampah'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                </td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_sampah'] ?>"><i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a>
                                                    <a href="<?= base_url('imadmin/sampah/') ?>vedit/<?= $rows['id_sampah'] ?>" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class=" bi bi-pencil-square"></i></a>
                                                    <a href="<?= base_url('imadmin/sampah/') ?>delete/<?= $rows['id_sampah'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a> <!-- onmouseover="this.href='javascript:void(0)'"-->
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
<!-- Modal View  -->
<?php foreach ($sampahs as $row) : ?>
    <div class="modal fade" id="modalView<?= $row['id_sampah'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail : <?= ucwords($row['nama_sampah']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/imgs/be/img-sampah/' . $row['img_sampah']) ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8">
                            <label class="fs-6 fw-bold" style="color: #093277;">Detail</label>
                            <div class="row">
                                <div class="col-lg-4" style="color: #697fa8;">Kode Sampah</div>
                                <div class="col-lg-8"><?= strtoupper($row['kode_sampah_kat']) ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4" style="color: #697fa8;">Jenis Sampah</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_sampah_kat']) ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4" style="color: #697fa8;">Nama Sampah</div>
                                <div class="col-lg-8"><?= ucwords($row['nama_sampah']) ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4" style="color: #697fa8;">Poin Sampah</div>
                                <div class="col-lg-8"><?= number_format($row['poin_sampah']) . ' / ' . $row['satuan_sampah'] ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4" style="color: #697fa8;">Status Sampah</div>
                                <div class="col-lg-8">
                                    <?php if ($row['status_sampah'] == '1') : ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('aktif') ?></span>
                                    <?php elseif ($row['status_sampah'] == '0') : ?>
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('tidak aktif') ?></span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4" style="color: #697fa8;">Deskripsi Sampah</div>
                                <div class="col-lg-8"><?= $row['deskripsi_sampah'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- End Modal View  -->