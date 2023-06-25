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
                                    <h5 class="card-title text-center pb-0 fs-4">Lupa Password</h5>
                                    <p class="text-center small">Masukkan Username dan Email Anda</p>
                                </div>

                                <?= $this->session->flashdata('pesan'); ?>

                                <form action="<?= base_url('forgot') ?>" method="POST" class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="username" class="form-label"><i class="bi bi-person"></i> Username</label>
                                        <div class="input-group has-validation">
                                            <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" autofocus required>
                                            <div class="invalid-feedback">Username Belum terisi !</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label"><i class="bi bi-lock"></i> Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="email@gmail.com" required>
                                        <div class="invalid-feedback">Email Belum terisi !</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-danger w-100" type="submit" name="reques"><i class="bi bi-send"></i> Kirim Permintaan</button>
                                    </div>

                                    <div class="col-12">
                                        <p class="small mb-0"><a href="<?= base_url('auth') ?>">Kembali ke halaman Login </a></p>
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