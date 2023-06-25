<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/nasabah') ?>">Data Nasabah</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url() ?>assets/imgs/be/img-nasabah/<?= $nasabah['img_nasabah'] ?>" alt="Profile" class="rounded-circle">
                        <h2><?= ucwords($nasabah['nama_nasabah']) ?></h2>
                        <h3 class="mt-2"><?= ucwords('perolehan Poin') ?></h3>
                        <h3><?= number_format($nasabah['poin_nasabah']) ?></h3>
                        <div class="social-links mt-2">
                            <a class="fs-6">Bergabung <?= date('d M Y', $nasabah['date_join_nsb']) ?></a>
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
                                    <div class="col-lg-9 col-md-8"><?= $nasabah['username'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($nasabah['nama_nasabah']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Pekerjaan</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($nasabah['pekerjaan_nasabah']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?= $nasabah['email_nsb'] ?>
                                        <?php if ($nasabah['email_nsb_verif'] == 0) : ?>
                                            <span class="badge bg-warning text-black" role="button"><i class="bi bi-exclamation-octagon"></i> Harap Verifikasi Email</span>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No WhatsApp</div>
                                    <div class="col-lg-9 col-md-8">+62<?= $nasabah['no_tlp_nsb'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Status</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php if ($nasabah['status_nasabah'] == '1') : ?>
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('aktif') ?></span>
                                        <?php elseif ($nasabah['status_nasabah'] == '0') : ?>
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('tidak aktif') ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($nasabah['alamat']) . ' RT. ' . $nasabah['alamat_rt'] . ' RW. ' . $nasabah['alamat_rw'] ?></div>
                                </div>

                                <div class="col-12 mb-3 mt-4 modal-footer">
                                    <a href="<?= base_url('imadmin/nasabah') ?>" class="btn btn-primary me-4">Kembali</a>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="<?= base_url('imadmin/nasabah/') ?>update" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-nasabah/<?= $nasabah['img_nasabah'] ?>" alt="Profile">
                                            <div class="pt-2">
                                                <div class="fileUpload btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i>
                                                    <input type="file" class="upload" name="img_nasabah" />
                                                </div>
                                                <?php if ($nasabah['img_nasabah'] != 'default_img.png') : ?>
                                                    <a href="<?= base_url('imadmin/nasabah/') ?>reimg/<?= $nasabah['id_nasabah'] ?>" class="btn btn-danger btn-sm btn-removeImg" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="username" value="<?= $nasabah['username'] ?>" disabled required oninvalid="this.setCustomValidity('Username Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="poin" class="col-md-4 col-lg-3 col-form-label">Poin Nasabah<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="poin" type="number" class="form-control" id="poin" value="<?= ucwords($nasabah['poin_nasabah']) ?>" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="<?= ucwords($nasabah['nama_nasabah']) ?>" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="job" class="col-md-4 col-lg-3 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="job" type="text" class="form-control" id="job" value="<?= ucwords($nasabah['pekerjaan_nasabah']) ?>" required oninvalid="this.setCustomValidity('Pekerjaan Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No WhatsApp<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $nasabah['no_tlp_nsb'] ?>" required oninvalid="this.setCustomValidity('No Handphone Harus Diisi !')" oninput="setCustomValidity('')" placeholder="8123xxx" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="status_nasabah" class="col-md-4 col-lg-3 col-form-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="status_nasabah" class="form-select" name="status_nasabah" value="<?= $nasabah['status_nasabah'] ?>" readonly required oninvalid="this.setCustomValidity('Status Harus Diisi !')" oninput="setCustomValidity('')">
                                                <?php foreach ($statuss as $status) : ?>
                                                    <?php if ($status == $nasabah['status_nasabah']) : ?>
                                                        <option value="1" selected><?= ucwords('aktif') ?></option>
                                                    <?php else : ?>
                                                        <option value="0" selected><?= ucwords('tidak aktif') ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="#" class="col-md-4 col-lg-3 col-form-label">Alamat\Rw\Rt <i class="text-danger">*</i></label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" style="height: 40px" name="alamat" placeholder="Jl/Kp.."><?= ucwords($nasabah['alamat']) ?></textarea>
                                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('alamat') ?></span>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="rw" name="rw" value="<?= $nasabah['alamat_rw'] ?>" placeholder="RW">
                                                    <span class="text-danger" style="font-size: 13px;"><?= form_error('rw') ?></span>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="rt" name="rt" value="<?= $nasabah['alamat_rt'] ?>" placeholder="RT">
                                                    <span class="text-danger" style="font-size: 13px;"><?= form_error('rt') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="in" value="<?= $nasabah['id_nasabah'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form action="<?= base_url('imadmin/nasabah/') ?>updateEmail" method="post">

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email" placeholder="email@email.com" required oninvalid="this.setCustomValidity('Email Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <input type="hidden" name="in" value="<?= $nasabah['id_nasabah'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="<?= base_url('imadmin/nasabah/') ?>updatePass" method="post">

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

                                    <input type="hidden" name="in" value="<?= $nasabah['id_nasabah'] ?>">

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