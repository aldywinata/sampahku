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

                        <form action="<?= base_url('imadmin/nasabah/') ?>vadd" method="post">
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
                                                <a href="#" class="">Nama Nasabah</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Alamat</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">RT</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">RW</a>
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
                                        foreach ($nasabah as $row) : ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $no++ ?></th>
                                                <td>
                                                    <img src="<?= base_url('assets/imgs/be/img-nasabah/' . $row['img_nasabah']) ?>" class=" img-size rounded" alt="">
                                                </td>
                                                <td><?= ucwords($row['nama_nasabah']) ?></td>
                                                <td><?= ucwords($row['alamat']) ?></td>
                                                <td><?= $row['alamat_rt'] ?></td>
                                                <td><?= $row['alamat_rw'] ?></td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $row['id_nasabah']; ?>', 'imadmin/nasabah/updateStatus')" <?= ($row['status_nasabah'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('imadmin/nasabah/') ?>profile/<?= $row['id_nasabah'] ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"><i class="bi bi-info-circle"></i></a>
                                                    <?php if ($row['email_nsb_verif'] == 0) : ?>
                                                        <a href="<?= base_url('imadmin/nasabah/') ?>reverif/<?= $row['id_nasabah'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Verifikasi Ulang"><i class="bi bi-patch-check"></i></a>
                                                    <?php endif ?>
                                                    <a href="<?= base_url('imadmin/nasabah/') ?>delete/<?= $row['id_nasabah'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a> <!-- onmouseover="this.href='javascript:void(0)'"-->
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