<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/users') ?>">Data Users</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url() ?>assets/imgs/be/img-users/<?= $user['img_users'] ?>" alt="Profile" class="rounded-circle">
                        <h2><?= ucwords($user['nama_users']) ?></h2>
                        <h3><?= ucwords($user['nama_role']) ?></h3>
                        <div class="social-links mt-2">
                            <a class="fs-6">Bergabung <?= date('d M Y', $user['date_join']) ?></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Detail</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Ganti Email</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                    <div class="col-lg-9 col-md-8"><?= $user['username'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($user['nama_users']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= $user['email'] ?>
                                        <?php if ($user['email_verif'] == 0) : ?>
                                            <span class="badge bg-warning text-black" role="button"><i class="bi bi-exclamation-octagon"></i> Harap Verifikasi Email</span>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No Handphone</div>
                                    <div class="col-lg-9 col-md-8"><?= $user['no_tlp'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Level</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($user['nama_role']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Status</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php if ($user['status_users'] == '1') : ?>
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('aktif') ?></span>
                                        <?php elseif ($user['status_users'] == '0') : ?>
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('tidak aktif') ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="col-12 mb-3 mt-4 modal-footer">
                                    <a href="<?= base_url('imadmin/users') ?>" class="btn btn-primary me-4">Kembali</a>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="<?= base_url('imadmin/users/') ?>update" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-users/<?= $user['img_users'] ?>" alt="Profile">
                                            <div class="pt-2">
                                                <div class="fileUpload btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i>
                                                    <input type="file" class="upload" name="img_users" />
                                                </div>
                                                <?php if ($user['img_users'] != 'default_img.png') : ?>
                                                    <a href="<?= base_url('imadmin/users/') ?>reimg/<?= $user['id_users'] ?>" class="btn btn-danger btn-sm btn-removeImg" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="username" value="<?= $user['username'] ?>" disabled required oninvalid="this.setCustomValidity('Username Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="<?= ucwords($user['nama_users']) ?>" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No Handphone<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_hp" type="number" class="form-control" id="no_hp" value="<?= $user['no_tlp'] ?>" required oninvalid="this.setCustomValidity('No Handphone Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Level<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="iRole" id="iRole" class="form-select" required oninvalid="this.setCustomValidity('Level Harus Diisi !')" oninput="setCustomValidity('')">
                                                <?php foreach ($roles as $role) : ?>
                                                    <?php if ($role['status_role'] == '1') : ?>
                                                        <?php if ($role['nama_role'] != 'administrator') : ?>
                                                            <?php if ($user['id_users_role'] == $role['id_users_role']) : ?>
                                                                <option value="<?= $role['id_users_role'] ?>" selected><?= ucwords($role['nama_role']) ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $role['id_users_role'] ?>"><?= ucwords($role['nama_role']) ?></option>
                                                            <?php endif; ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="status_users" class="col-md-4 col-lg-3 col-form-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="status_users" class="form-select" name="status_users" value="<?= $user['status_users'] ?>" readonly required oninvalid="this.setCustomValidity('Status Harus Diisi !')" oninput="setCustomValidity('')">
                                                <?php foreach ($statuss as $status) : ?>
                                                    <?php if ($status == $user['status_users']) : ?>
                                                        <option value="1" selected><?= ucwords('aktif') ?></option>
                                                    <?php else : ?>
                                                        <option value="0" selected><?= ucwords('tidak aktif') ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="iu" value="<?= $user['id_users'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form action="<?= base_url('imadmin/users/') ?>updateEmail" method="post">

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email" placeholder="email@email.com" required oninvalid="this.setCustomValidity('Email Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <input type="hidden" name="iu" value="<?= $user['id_users'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="<?= base_url('imadmin/users/') ?>updatePass" method="post">

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword" required oninvalid="this.setCustomValidity('Password Baru Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword" required oninvalid="this.setCustomValidity('Password Baru Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <input type="hidden" name="iu" value="<?= $user['id_users'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->