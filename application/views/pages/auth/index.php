<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" alt="">
                                <span class="d-none d-lg-block"><?= ucwords($info['nama_sysfo']) ?></span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2 text-center">
                                    <h5 class="card-title pb-0 fs-4">Login to Access</h5>
                                    <p class=small"><?= ucwords($info['nama_sysfo']) ?></p>
                                    <span class="btn badge bg-danger text-light btn-akun">AKUN</span>
                                </div>

                                <?= $this->session->flashdata('pesan'); ?>

                                <form action="<?= base_url('auth') ?>" method="POST" class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="username" class="form-label"><i class="bi bi-person"></i> Username</label>
                                        <div class="input-group has-validation">
                                            <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                            <input type="text" name="username" class="form-control" id="username" placeholder="..." autofocus required>
                                            <div class="invalid-feedback">Username Belum terisi !</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="password" class="form-label"><i class="bi bi-lock"></i> Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="..." required>
                                        <div class="invalid-feedback">Password Belum terisi !</div>
                                    </div>

                                    <div class="col-6">
                                        <a href="<?= base_url() ?>" class="btn btn-secondary w-100">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary w-100" type="submit" name="loggin">Login</button>
                                    </div>

                                    <div class="col-6">
                                        <p class="small mb-0"><a href="" class="btn-join"><i class="bi bi-box-arrow-in-right"></i> Bergabung? </a></p>
                                    </div>

                                    <div class="col-6">
                                        <p class="small mb-0"><a href="<?= base_url('forgot') ?>"><i class="bi bi-lock-fill"></i> Lupa Password? </a></p>
                                    </div>

                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="<?= base_url() ?>"><?= ucwords($info['nama_sysfo']) ?></a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->