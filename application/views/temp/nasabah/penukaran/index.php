<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('nasabah/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <!-- <div class="row mb-3">
                <div class="col-md-5">
                    <div class="row">
                        <label for="filter" class="col-md-4 col-lg-3 col-form-label fw-bold">Tampilkan</label>
                        <div class="col-lg-6">
                            <select class=" form-control" id="filter" name="filter" onchange="filterData('nasabah/penukaran/index')" placeholder="~ Pilih ~">
                                <option value="all">~ Semua ~</option>
                                <option value="poin_kecil" <?= set_value('filter') == 'poin_kecil' ? 'selected' : '' ?>>Poin Terkecil</option>
                                <option value="poin_besar" <?= set_value('filter') == 'poin_besar' ? 'selected' : '' ?>>Poin Terbesar</option>
                                <option value="tukar_barang" <?= set_value('filter') == 'tukar_barang' ? 'selected' : '' ?>>Tukar Barang</option>
                                <option value="midtrans" <?= set_value('filter') == 'midtrans' ? 'selected' : '' ?>>Voucher</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row" id="rewardContainer">
                <?php foreach ($rewards as $row) : ?>
                    <?php if ($row['status_reward'] == '1') : ?>
                        <?php if ($row['jenis_reward'] == 'tukar_barang' && $row['stok_reward'] > 0 || $row['jenis_reward'] == 'voucher') : ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="<?= base_url() ?>assets/imgs/be/img-reward/<?= $row['img_reward'] ?>" class="card-img-top rewards-img" alt="...">
                                    <div class="card-body mt-2">
                                        <span class="card-subtitle text-secondary"><?= ucwords($row['nama_reward']) ?></span>
                                    </div>
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <span class="badge rounded-pill bg-warning text-dark" style="font-size: 13px;"><i class="bi bi-coin me-1"></i> <?= number_format($row['poin_reward']) ?> Poin</span>
                                        <!-- <form action="<?= base_url('nasabah/penukaran/vtransaksi') ?>" method="post">
                                            <input type="hidden" name="kode" value="<?= $row['kode_reward'] ?>">
                                            <button type="submit" class="btn btn-primary">Tukar</button>
                                        </form> -->
                                        <a class="btn btn-primary" href="<?= base_url() ?>nasabah/penukaran/vtransaksi/<?= $row['kode_reward'] ?>">Tukar</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                <?php endforeach ?>

            </div>
        </div>
    </section>

</main>