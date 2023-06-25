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
                            <li>Pilih Metode Penukaran</li>
                            <li>Masukan Nama dan Nomor Tujuan</li>
                            <li>Klik Tukar</li>
                            <li>Hadiah Penukaran Berupa Voucher akan diproses 3 hari kerja</li>
                        </ol>

                        <form action="<?= base_url('nasabah/penukaran/transaksi') ?>" method="post">
                            <div class="col-12 mb-3">
                                <label for="metode" class="form-label">Metode Penukaran <i class="text-danger">*</i></label>
                                <select class="mySelect2 form-control" id="metode" name="metode" data-placeholder="~ Pilih ~" onchange="metodeChange()" required oninvalid="this.setCustomValidity('Metode Penukaran Harus Diisi !')" oninput="setCustomValidity('')">
                                    <option></option>
                                    <option value="bank" <?= set_value('metode') == 'bank' ? 'selected' : '' ?>>BANK</option>
                                    <option value="ewallet" <?= set_value('metode') == 'ewallet' ? 'selected' : '' ?>>E-Wallet</option>
                                </select>
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('metode') ?></span>
                            </div>
                            <div class="col-12 mb-3" id="divBank" style="display: none;">
                                <label for="bank" class="form-label">Bank <i class="text-danger">*</i></label>
                                <select class="mySelect2 form-control" id="bank" name="bank" data-placeholder="~ Pilih ~" onchange="metodeChange()" oninvalid="this.setCustomValidity('BANK Harus Diisi !')" oninput="setCustomValidity('')">
                                    <option></option>
                                    <option value="BRI" <?= set_value('bank') == 'BRI' ? 'selected' : '' ?>>BRI</option>
                                    <option value="BCA" <?= set_value('bank') == 'BCA' ? 'selected' : '' ?>>BCA</option>
                                    <option value="MANDIRI" <?= set_value('bank') == 'MANDIRI' ? 'selected' : '' ?>>MANDIRI</option>
                                </select>
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('bank') ?></span>
                            </div>
                            <div class="col-12 mb-3" id="divEwallet" style="display: none;">
                                <label for="ewallet" class="form-label">E-Wallet <i class="text-danger">*</i></label>
                                <select class="mySelect2 form-control" id="ewallet" name="ewallet" data-placeholder="~ Pilih ~" onchange="metodeChange()" oninvalid="this.setCustomValidity('E-Wallet Harus Diisi !')" oninput="setCustomValidity('')">
                                    <option></option>
                                    <option value="DANA" <?= set_value('ewallet') == 'DANA' ? 'selected' : '' ?>>DANA</option>
                                    <option value="GOPAY" <?= set_value('ewallet') == 'GOPAY' ? 'selected' : '' ?>>GOPAY</option>
                                    <option value="OVO" <?= set_value('ewallet') == 'OVO' ? 'selected' : '' ?>>OVO</option>
                                </select>
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('bank') ?></span>
                            </div>
                            <div class="col-12 mb-3" id="divNama" style="display: none;">
                                <label for="nama" class="form-label">Nama Tujuan <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="..." required oninvalid="this.setCustomValidity('Nama Harus Diisi !')" oninput="setCustomValidity('')">
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                            </div>
                            <div class="col-12 mb-3" id="divNomor" style="display: none;">
                                <label for="nomor" class="form-label">Nomor Tujuan <i class="text-danger">*</i></label>
                                <input type="number" class="form-control" id="nomor" name="nomor" value="<?= set_value('nomor') ?>" required placeholder="..." required oninvalid="this.setCustomValidity('Nomor Harus Diisi !')" oninput="setCustomValidity('')">
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('nomor') ?></span>
                            </div>
                            <p class="card-text text-danger mt-3" style="font-size: 15px;">*Harap cek kembali Nomor dan Nama tujuan. Jika terjadi kesalahan pengiriman, diluar tanggung jawab</p>
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