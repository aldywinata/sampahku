<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title><?= ucwords($info['nama_sysfo']) ?></title>

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" rel="icon">
    <link href="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Style -->
    <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="<?= base_url(); ?>assets/js/be/jquery-3.6.3.min.js"></script>

    <!-- Template FE CSS File -->
    <link href="<?= base_url() ?>assets/css/fe/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['icon_sysfo'] ?>" alt="">
                <span><?= ucwords($info['nama_sysfo']) ?></span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#services">Daftar Harga</a></li>
                    <li><a class="nav-link scrollto" href="#testimonials">Testimonial</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#portfolio">Dokumentasi</a></li> -->
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="<?= base_url('auth') ?>">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Selamat Datang <br> di Website <?= ucwords($info['nama_sysfo']) ?></h1>
                    <h2 data-aos="fade-up" data-aos-delay="400"><?= ucwords($info['slogan_sysfo']) ?></h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Selengkapnya</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero_sysfo'] ?>" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Kami</h3>
                            <h2>Lebih dari sekedar Bank Sampah </h2>
                            <p>
                                <?= ucwords($info['about_sysfo']) ?>
                            </p>
                            <div class="text-center text-lg-start">
                                <a href="#contact" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Daftar Sekarang</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="<?= base_url() ?>assets/imgs/be/img-sysfo/<?= $info['img_hero2_sysfo'] ?>" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->
        <!-- ======= Values Section ======= -->
        <section id="values" class="values">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Keuntungan</h2>
                    <p>Kenapa harus ke <?= ucwords($info['nama_sysfo']) ?>?</p>
                </header>

                <div class="row">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="<?= base_url() ?>assets/imgs/fe/values-1.png" class="img-fluid" alt="">
                            <h3>Partnership</h3>
                            <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box ">
                            <img src="<?= base_url() ?>assets/imgs/fe/values-2.png" class="img-fluid" alt="">
                            <h3>Layanan Pengelolaan</h3>
                            <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src="<?= base_url() ?>assets/imgs/fe/values-3.png" class="img-fluid" alt="">
                            <h3>Benefit Nasabah</h3>
                            <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Values Section -->
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="<?= $jumNSB ?>" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Nasabah Bergabung</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-tags" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="<?= $jumSMP ?>" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Jenis Sampah</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-recycle" style="color: #bb0852;"></i>
                            <div>
                                <!-- <span data-purecounter-start="0" data-purecounter-end="<?= $jumKG ?>" data-purecounter-duration="1" class="purecounter"></span> -->
                                <span><?= $jumKG ?></span>
                                <p>Sampah dikumpulkan (KG)</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->
        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <header class="section-header">
                    <p>Mari Bergabung Bersama Kami</p>
                </header>

                <div class="row">
                    <div class="col-lg-6 mt-2 mb-tg-0 order-2 order-lg-1">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item" data-aos="fade-up">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                                    <h4>Daftar</h4>
                                    <p>Untuk bergabung dengan kami, harap datang ke pengelola <?= ucwords($info['nama_sysfo']) ?>.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="100">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                                    <h4>Kesepakatan</h4>
                                    <p>Pahami Ketentuan dan Persyaratan yang berlaku</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="200">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                                    <h4>Kumpulkan Sampah</h4>
                                    <p>Kumpulkan sampah berdasarkan kategori yang tersedia</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="300">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                                    <h4>Dapatkan Penghasilan</h4>
                                    <p>Tukar Sampahmu, lalu dapatkan uang</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <figure>
                                    <img src="<?= base_url() ?>assets/imgs/fe/features-1.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <figure>
                                    <img src="<?= base_url() ?>assets/imgs/fe/features-2.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <figure>
                                    <img src="<?= base_url() ?>assets/imgs/fe/features-3.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <figure>
                                    <img src="<?= base_url() ?>assets/imgs/fe/features-4.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Daftar Harga</h2>
                    <p>Daftar Harga Berdasarkan Jenis Sampah</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200">
                        <!-- <div class="row "></div> -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
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
                                                        <a href="#" class="">Kode</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Nama Sampah</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Poin</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Deskripsi</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($sampahs as $rows) : ?>
                                                    <tr>
                                                        <th scope="row" class="text-center"><?= $no++ ?></th>
                                                        <td>
                                                            <img src="<?= base_url('assets/imgs/be/img-sampah/' . $rows['img_sampah']) ?>" style="width: 100px; height: 80px" class=" img-size rounded" alt="">
                                                        </td>
                                                        <td><?= strtoupper($rows['kode_sampah_kat']) ?></td>
                                                        <td><a href="" class="" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_sampah'] ?>"> <?= ucwords($rows['nama_sampah']) ?></a></td>
                                                        <td><?= number_format($rows['poin_sampah']) ?></td>
                                                        <td><?= ucwords($rows['deskripsi_sampah']) ?></td>
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

            </div>

            <?php foreach ($sampahs as $row) : ?>
                <div class="modal fade" id="modalView<?= $row['id_sampah'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail : <?= ucwords($row['nama_sampah']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= base_url('assets/imgs/be/img-sampah/' . $row['img_sampah']) ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="fs-6 fw-bold" style="color: #093277;">Detail</label>
                                        <div class="row">
                                            <div class="col-lg-4" style="color: #697fa8;">Kode Sampah</div>
                                            <div class="col-lg-8"><?= strtoupper($row['kode_sampah_kat']) ?></div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-lg-4" style="color: #697fa8;">Jenis Sampah</div>
                                            <div class="col-lg-8"><?= ucwords($row['nama_sampah_kat']) ?></div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-lg-4" style="color: #697fa8;">Nama Sampah</div>
                                            <div class="col-lg-8"><?= ucwords($row['nama_sampah']) ?></div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-lg-4" style="color: #697fa8;">Poin Sampah</div>
                                            <div class="col-lg-8"><?= number_format($row['poin_sampah']) . ' / ' . $row['satuan_sampah'] ?></div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-lg-4" style="color: #697fa8;">Status Sampah</div>
                                            <div class="col-lg-8">
                                                <?php if ($row['status_sampah'] == '1') : ?>
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('aktif') ?></span>
                                                <?php elseif ($row['status_sampah'] == '0') : ?>
                                                    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('tidak aktif') ?></span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-lg-4" style="color: #697fa8;">Deskripsi Sampah</div>
                                            <div class="col-lg-8"><?= $row['deskripsi_sampah'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </section><!-- End Services Section -->
        <!-- ======= Portfolio Section ======= -->
        <!-- <section id="portfolio" class="portfolio">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Dokumentasi</h2>
                    <p>Dokumentasi Foto Kegiatan</p>
                </header>

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

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

        </section>End Portfolio Section -->
        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Testimonial</h2>
                    <p>Apa Kata Mereka?</p>
                </header>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">

                        <?php foreach ($reviews as $row) : ?>
                            <?php if ($row['status_review'] == '1') : ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="stars">
                                            <?php
                                            for ($i = 5; $i >= 1; $i--) {
                                                if ($i <= $row['rating_review']) {
                                                    echo '<i class="bi bi-star-fill"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p>
                                            <?= $row['deskripsi_review'] ?>
                                        </p>
                                        <div class="profile mt-auto">
                                            <img src="<?= base_url() ?>assets/imgs/be/img-nasabah/<?= $row['img_nasabah'] ?>" class="testimonial-img" alt="">
                                            <h3><?= ucwords($row['nama_nasabah']) ?></h3>
                                            <h4><?= ucwords($row['pekerjaan_nasabah']) ?></h4>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            <?php endif ?>
                        <?php endforeach ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>assets/imgs/fe/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>assets/imgs/fe/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>assets/imgs/fe/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>assets/imgs/fe/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>

        </section><!-- End Testimonials Section -->
        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Kerja Sama</h2>
                    <p>Pihak Kerja Sama</p>
                </header>

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php foreach ($partners as $row) : ?>
                            <div class="swiper-slide"><img src="<?= base_url() ?>assets/imgs/be/img-partner/<?= $row['img_partner'] ?>" class="img-fluid" alt=""></div>
                        <?php endforeach ?>
                        <div class="swiper-slide"><img src="<?= base_url() ?>assets/imgs/fe/clients/client-2.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="<?= base_url() ?>assets/imgs/fe/clients/client-3.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="<?= base_url() ?>assets/imgs/fe/clients/client-4.png" class="img-fluid" alt=""></div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>

        </section><!-- End Clients Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Contact</h2>
                    <p>Hubungi Kami</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p><?= ucwords($info['alamat_sysfo']) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-whatsapp"></i>
                                    <h3>WhatsApp</h3>
                                    <p><?= $info['no_sysfo'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email</h3>
                                    <p><?= $info['email_sysfo'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-clock"></i>
                                    <h3>Jam Kerja</h3>
                                    <p><?= ucwords($info['hari_kerja_sysfo']) ?><br><?= ucwords($info['jam_kerja_sysfo']) ?></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="" method="post" class="php-email-form">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Kirim</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </section><!-- End Contact Section -->

    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span><?= ucwords($info['nama_sysfo']) ?></span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="#"><?= ucwords($info['nama_sysfo']) ?></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url() ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>assets/vendor/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template FE JS File -->
    <script src="<?= base_url() ?>assets/js/fe/main.js"></script>
    <script src="<?= base_url() ?>assets/js/be/myjs.js"></script>
</body>

</html>