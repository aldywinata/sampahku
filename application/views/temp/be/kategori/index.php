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
                                                <a href="#" class="">Kode Sampah</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Jenis Sampah</a>
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
                                        foreach ($kategoris as $rows) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $no++ ?></th>
                                                <td><?= strtoupper($rows['kode_sampah_kat']) ?></td>
                                                <td><?= ucwords($rows['nama_sampah_kat']) ?></td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $rows['id_sampah_kat']; ?>', 'imadmin/kategori/updateStatus')" <?= ($rows['status_sampah_kat'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                </td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $rows['id_sampah_kat'] ?>"><i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                                    <a href="<?= base_url('imadmin/kategori/') ?>delete/<?= $rows['id_sampah_kat'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a> <!-- onmouseover="this.href='javascript:void(0)'"-->
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
                    <h5 class="modal-title">Tambah Kategori Sampah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" method="POST" action="<?= base_url('imadmin/kategori/') ?>add">

                        <div class="col-12">
                            <label for="kode" class="form-label">Kode Kategori <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" id="kode" name="kode" onkeyup="cekJumlah(3); this.value = this.value.toUpperCase();" required oninvalid="this.setCustomValidity('Kode Kategori Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                            <label class="text-danger" id="msg" style="font-size: 13px;"></label>
                        </div>

                        <div class="col-12">
                            <label for="kategori" class="form-label">Kategori Sampah <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required oninvalid="this.setCustomValidity('Kategori Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
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
    <?php foreach ($kategoris as $row) : ?>
        <div class="modal fade" id="modalUpdate<?= $row['id_sampah_kat'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori Sampah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row g-3" method="POST" action="<?= base_url('imadmin/kategori/') ?>update">

                            <div class="col-12">
                                <label for="kode" class="form-label">Kode Kategori <label class="text-danger">*</label></label>
                                <input type="text" class="form-control bg-secondary" id="kode" name="kode" style="--bs-bg-opacity: .1;" value="<?= $row['kode_sampah_kat'] ?>" readonly required oninvalid="this.setCustomValidity('NIP Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                <label class="text-danger" style="font-size: 13px;">*Kode Kategori tidak dapat diubah</label>
                            </div>

                            <div class="col-12">
                                <label for="kategori" class="form-label">Kategori Sampah <label class="text-danger">*</label></label>
                                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= ucwords($row['nama_sampah_kat']) ?>" required oninvalid="this.setCustomValidity('Kategori Sampah Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                            </div>

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