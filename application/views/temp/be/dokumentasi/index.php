<main id="main" class="main">
    <div class="pagetitle">
        <h1>Foto <?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Foto <?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section portfolio">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Foto <?= $title ?></h5>

                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-circle"></i> Tambah</button>

                        <div class="row gy-4 portfolio-container">

                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                <div class="portfolio-wrap">
                                    <img src="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="<?= base_url() ?>assets/imgs/fe/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"><i class="bi bi-arrows-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>