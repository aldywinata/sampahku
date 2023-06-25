<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="#" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" alt="">
                                <span class="d-none d-lg-block"><?= ucwords($info['nama_sysfo']) ?></span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                    <p class="text-center small"><?= ucwords($info['nama_sysfo']) ?></p>
                                </div>

                                <?= $this->session->flashdata('pesan'); ?>

                                <form action="<?= base_url('reset') ?>" method="POST" class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="password" class="form-label"><i class="bi bi-lock"></i> Password Baru</label>
                                        <div class="input-group has-validation">
                                            <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                            <input type="password" name="password" class="form-control" id="password" placeholder="..." autofocus required>
                                            <div class="invalid-feedback">Password Baru Belum terisi !</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="password2" class="form-label"><i class="bi bi-lock"></i> Ulangi Password Baru</label>
                                        <input type="password" name="password2" class="form-control" id="password2" placeholder="..." required>
                                        <div class="invalid-feedback">Password Baru Belum terisi !</div>
                                    </div>

                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <input type="hidden" name="token" value="<?= $token ?>">

                                    <div class="col-12 mb-2">
                                        <button class="btn btn-danger w-100" type="submit" name="reset"><i class="bi bi-send"></i> Reset</button>
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