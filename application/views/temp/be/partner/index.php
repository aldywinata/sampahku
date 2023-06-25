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

                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-circle"></i> Tambah</button>

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
                                                <a href="#" class="">Nama Partner</a>
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
                                        foreach ($partners as $row) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $no++ ?></th>
                                                <td>
                                                    <img src="<?= base_url('assets/imgs/be/img-partner/' . $row['img_partner']) ?>" class="img-size rounded" alt="">
                                                </td>
                                                <td><?= ucwords($row['nama_partner']) ?></td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $row['id_partner']; ?>', 'imadmin/partner/updateStatus')" <?= ($row['status_partner'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                </td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['id_partner'] ?>"><i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                                    <a href="<?= base_url('imadmin/partner/') ?>delete/<?= $row['id_partner'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">

        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data <?= $title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" method="POST" action="<?= base_url('imadmin/partner/') ?>add" enctype="multipart/form-data">

                        <div class=" col-12">
                            <label for="foto" class="form-label">Foto <i class="text-danger">*</i></label>
                            <input class="form-control" type="file" name="foto" id="foto" accept=".png, .jpeg, .jpg" required oninvalid="this.setCustomValidity('Foto Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="col-12">
                            <label for="nama" class="form-label">Nama Partner <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" id="nama" name="nama" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="tambah" id="btn-tam" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal Tambah -->
    <!-- Modal Edit -->
    <?php foreach ($partners as $row) : ?>
        <div class="modal fade" id="modalUpdate<?= $row['id_partner'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit <?= $title ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row g-3" method="POST" action="<?= base_url('imadmin/partner/') ?>update" enctype="multipart/form-data">

                            <div class="col-12">
                                <label for="kode" class="form-label">Foto <label class="text-danger" style="font-size: 13px;">*(Opsional)</label></label>
                                <div class="row">
                                    <img src="<?= base_url() ?>assets/imgs/be/img-partner/<?= $row['img_partner'] ?>" style="width: 200px; height: 150px;" alt="Profile">
                                    <div class="pt-2">
                                        <div class="fileUpload btn btn-primary btn-sm">
                                            <i class="bi bi-upload"></i>
                                            <input type="file" class="upload" name="foto" accept=".png, .jpeg, .jpg" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="nama" class="form-label">Nama Partner <label class="text-danger">*</label></label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= ucwords($row['nama_partner']) ?>" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                            </div>

                            <input type="hidden" name="idp" value="<?= $row['id_partner'] ?>">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="edit" id="btn-tam" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- End Modal Edit -->


</main>