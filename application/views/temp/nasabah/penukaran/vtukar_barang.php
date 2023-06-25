<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('nasabah/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('nasabah/penukaran') ?>">Penukaran Poin</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mt-2">
                <div class="card">
                    <img src="<?= base_url() ?>assets/imgs/be/img-reward/<?= $reward['img_reward'] ?>" class="card-img-top rewards-img2" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Kode : <?= $reward['kode_reward'] ?></h5>
                        <p class="card-text"><span class="fw-bold"> Penukaran :</span> <?= ucwords($reward['nama_reward']) ?></p>
                        <p class="card-text"><span class="fw-bold"> Poin dibutuhkan :</span> <?= number_format($reward['poin_reward']) ?> Poin</p>
                        <span>Cara Penukaran :</span>
                        <ol>
                            <li>Klik Tukar</li>
                            <li>Hadiah Penukaran Berupa Barang akan diproses 3 hari kerja</li>
                            <li>Anda akan dihubungi oleh petugas untuk konfirmasi Penukaran. Patikan Nomor yang terdaftar adalah Nomor Aktif</li>
                            <li>Hadiah akan diantar ke alamat Nasabah. Pastikan Alamat yang terdaftar merupakan Alamat yang Benar</li>
                        </ol>
                        <p class="card-text text-danger" style="font-size: 15px;">*Informasi dapat berubah sewaktu-waktu</p>
                        <form action="<?= base_url('nasabah/penukaran/transaksi') ?>" method="post">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <a href="<?= base_url('nasabah/penukaran') ?>" class="btn btn-secondary">Kembali</a>
                                <input type="hidden" name="kode" value="<?= $this->uri->segment('4') ?>">
                                <button type="submit" name="btnAdd" class="btn btn-primary">Tukar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

</main>