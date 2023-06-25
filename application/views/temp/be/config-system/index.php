<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= ucwords($title) ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= ucwords($title) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" alt="Profile" class="rounded-circle">
                        <div class="social-links mt-2">
                            <h2><?= ucwords($info['nama_sysfo']) ?></h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero_sysfo'] ?>" alt="Profile" class="img-fluid">
                        <div class="social-links mt-2">
                            <a class="fs-6"><?= ucwords('Image Thumbnail') ?></a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero2_sysfo'] ?>" alt="Profile" class="img-fluid">
                        <div class="social-links mt-2">
                            <a class="fs-6"><?= ucwords('Image About') ?></a>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">System Detail</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit System</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Edit Kontak</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">System Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($info['nama_sysfo']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Slogan</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($info['slogan_sysfo']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tentang</div>
                                    <div class="col-lg-9 col-md-8"><?= $info['about_sysfo'] ?>
                                    </div>
                                </div>

                                <h5 class="card-title">Kontak Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No Handphone</div>
                                    <div class="col-lg-9 col-md-8"><?= $info['no_sysfo'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= $info['email_sysfo'] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Hari Kerja</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($info['hari_kerja_sysfo']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jam Kerja</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($info['jam_kerja_sysfo']) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8"><?= ucwords($info['alamat_sysfo']) ?></div>
                                </div>

                                <div class="col-12 mb-3 mt-4 modal-footer">
                                    <a href="<?= base_url('imadmin/dashboard') ?>" class="btn btn-primary me-4">Dashboard</a>
                                </div>


                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="<?= base_url('imadmin/config/') ?>update" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Icon</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" alt="Profile">
                                            <div class="pt-2">
                                                <div class="fileUpload btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i>
                                                    <input type="file" class="upload" name="foto1" accept=".png, .jpeg, .jpg" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image Thumbnail</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero_sysfo'] ?>" alt="Profile">
                                            <div class="pt-2">
                                                <div class="fileUpload btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i>
                                                    <input type="file" class="upload" name="foto2" accept=".png, .jpeg, .jpg" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero2_sysfo'] ?>" alt="Profile">
                                            <div class="pt-2">
                                                <div class="fileUpload btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i>
                                                    <input type="file" class="upload" name="foto3" accept=".png, .jpeg, .jpg" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="<?= ucwords($info['nama_sysfo']) ?>" required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="slogan" class="col-md-4 col-lg-3 col-form-label">Slogan <span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: auto" id="slogan" name="slogan" required oninvalid="this.setCustomValidity('Slogan Harus Diisi !')" oninput="setCustomValidity('')" placeholder="..."><?= ucwords($info['slogan_sysfo']) ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">Tentang <span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 100px" id="about" name="about" required oninvalid="this.setCustomValidity('About Harus Diisi !')" oninput="setCustomValidity('')" placeholder="..."><?= ucwords($info['about_sysfo']) ?></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form action="<?= base_url('imadmin/config/') ?>updateKontak" method="post">

                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No Handphone<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_hp" type="number" class="form-control" id="no_hp" value="<?= $info['no_sysfo'] ?>" required oninvalid="this.setCustomValidity('No Handphone Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email" value="<?= $info['email_sysfo'] ?>" required oninvalid="this.setCustomValidity('Email Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="hari" class="col-md-4 col-lg-3 col-form-label">Hari Kerja<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="hari" type="text" class="form-control" id="hari" value="<?= ucwords($info['hari_kerja_sysfo']) ?>" required oninvalid="this.setCustomValidity('Hari Kerja Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jam" class="col-md-4 col-lg-3 col-form-label">Jam Kerja<span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="jam" type="text" class="form-control" id="jam" value="<?= ucwords($info['jam_kerja_sysfo']) ?>" required oninvalid="this.setCustomValidity('Jam Kerja Harus Diisi !')" oninput="setCustomValidity('')" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: auto" id="alamat" name="alamat" required oninvalid="this.setCustomValidity('Alamat Harus Diisi !')" oninput="setCustomValidity('')" placeholder="..."><?= ucwords($info['alamat_sysfo']) ?></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->