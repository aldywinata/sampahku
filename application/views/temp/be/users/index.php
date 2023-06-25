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

                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-person-plus"></i> Tambah</button>

                        <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">

                            <div class="dataTable-container">
                                <table class="table datatable dataTable-table" style="font-size: 15px;" id="dataTables">
                                    <thead style="background-color: #F6F6FE;">
                                        <tr>
                                            <th class="text-center" scope="col" data-sortable>
                                                <a href="#" class=" disable">No</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Profil</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Nama Users</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Hak Akses</a>
                                            </th>
                                            <th scope="col" data-sortable>
                                                <a href="#" class="">Status Users</a>
                                            </th>
                                            <th class="text-center" scope="col" data-sortable>
                                                <a href="#" class="">Aksi</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($users as $row) : ?>
                                            <?php if ($row['nama_role'] != 'administrator') : ?>
                                                <tr>
                                                    <th scope="row" class="text-center"><?= $no++ ?></th>
                                                    <td>
                                                        <img src="<?= base_url('assets/imgs/be/img-users/' . $row['img_users']) ?>" class="rounded-circle img-size rounded" alt="">
                                                    </td>
                                                    <td><?= ucwords($row['nama_users']) ?></td>
                                                    <td><?= strtoupper($row['nama_role']) ?></td>
                                                    <td>
                                                        <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $row['id_users']; ?>', 'imadmin/users/updateStatus')" <?= ($row['status_users'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('imadmin/users/') ?>profile/<?= $row['id_users'] ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"><i class="bi bi-info-circle"></i></a>
                                                        <?php if ($row['email_verif'] == 0) : ?>
                                                            <a href="<?= base_url('imadmin/users/') ?>reverif/<?= $row['id_users'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Verifikasi Ulang"><i class="bi bi-patch-check"></i></a>
                                                        <?php endif ?>
                                                        <a href="<?= base_url('imadmin/users/') ?>delete/<?= $row['id_users'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="bi bi-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endif ?>
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
                    <h5 class="modal-title">Tambah Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row g-3" method="POST" action="<?= base_url('imadmin/users/') ?>add">

                        <div class="alert border-danger" style="border-style: dashed; font-size: 14px;">
                            <i class="bi bi-info-circle text-danger me-2"></i>Untuk Password gunakan Password Default : <i class="text-danger">users123</i></a><br>
                        </div>

                        <div class="col-12">
                            <label for="nama_user" class="form-label">Nama Users <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" id="nama_user" name="nama_user" required oninvalid="this.setCustomValidity('Nama Users Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="col-12">
                            <label for="akses" class="form-label">Hak Akses <label class="text-danger">*</label></label>
                            <select id="akses" class="form-select" name="akses" required oninvalid="this.setCustomValidity('Hak Akses Harus Diisi !')" oninput="setCustomValidity('')">
                                <?php foreach ($roles as $role) : ?>
                                    <?php if ($role['id_users_role'] != '1') : ?>
                                        <option value="<?= $role['id_users_role'] ?>"><?= ucwords($role['nama_role']) ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="username" class="form-label">Username <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" id="username" name="username" required oninvalid="this.setCustomValidity('Username Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" id="email" name="email" required oninvalid="this.setCustomValidity('Email Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="col-12">
                            <label for="nope" class="form-label">No Telepon <i class="text-danger">*</i></label>
                            <input type="number" class="form-control" id="nope" name="nope" required oninvalid="this.setCustomValidity('No Telepon Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal Tambah -->
</main>