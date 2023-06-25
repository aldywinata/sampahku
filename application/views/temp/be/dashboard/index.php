<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">

                <div class="row">
                    <!-- Nasabah Card -->
                    <div class="col-xl-4 col-md-2">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Nasabah</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= number_format($jumNSB) ?></h6>
                                        <span class="text-primary small pt-1 fw-bold">Nasabah</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Nasabah Card -->

                    <!-- Ketegori Card -->
                    <div class="col-xl-4 col-md-2">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Kategori</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= number_format($jumSMP) ?></h6>
                                        <span class="text-success small pt-1 fw-bold">Jenis Sampah</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Ketegori Card -->

                    <div class="col-xl-4 col-md-2">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Sampah <span>| Terkumpul</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-recycle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= ($jumBerat > 0) ? number_format($jumBerat, 2, '.', '') : '0' ?></h6>
                                        <span class="text-danger small pt-1 fw-bold">Kg</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- End Left side columns -->

            <!-- <div class="col-lg-4">
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Pengumuman</h5>

                        <?php foreach ($pengumumans as $pengumuman) :  ?>
                            <?php if ($pengumuman['status_pengumuman'] == '1') : ?>
                            <div class="post-item clearfix">
                                <h4 class="fw-bold fs-6"><a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $pengumuman['id_pengumuman'] ?>"><?= ucwords($pengumuman['judul_pengumuman']) ?></a></h4>
                                <p>
                                    <?php
                                    if (str_word_count($pengumuman['isi_pengumuman']) > 10) {
                                        echo substr($pengumuman['isi_pengumuman'], 0, 70) . "[...]";
                                    } else {
                                        echo $pengumuman['isi_pengumuman'];
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php endif ?>
                        <?php endforeach ?>
                        
                    </div>
                </div>
            </div> -->

        </div>
    </section>

</main><!-- End #main -->