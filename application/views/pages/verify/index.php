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
                                    <h5 class="card-title text-center pb-0 fs-4">Verifikasi Email <?= $stat ?></h5>
                                </div>

                                <div class="p-4 text-center">
                                    <img class="rounded img-size-verify rounded" src="<?= base_url() ?>assets/imgs/<?= $stat ?>.png" alt="">
                                </div>

                                <div class="col-12">
                                    <?= $msg ?>
                                </div>

                                <div class="col-12 mt-2">
                                    <?php if ($type == 'verify') : ?>
                                        <p class="small mb-0 text-center"><a href="<?= base_url('auth') ?>">Silahkan Login </a></p>
                                    <?php elseif ($type == 'change') : ?>
                                        <p class="small mb-0 text-center text-primary">Email Anda berhasil diganti</p>
                                    <?php else : ?>
                                        <p class="small mb-0 text-center text-primary">Hubungi Pihak Terkait Jika mengalami Kendala</p>
                                    <?php endif ?>
                                </div>

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