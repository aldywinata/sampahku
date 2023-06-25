<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/hadiah') ?>">Data Hadiah</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form <?= $title ?></h5>

                        <form action="<?= base_url('imadmin/hadiah/') ?>add" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label">Gambar <i class="text-danger">*</i></label>
                                    <input class="form-control" type="file" name="foto" id="foto" accept=".png, .jpeg, .jpg" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('foto') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="jenis" class="form-label">Jenis Hadiah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="jenis" name="jenis" data-placeholder="~ Pilih ~" onchange="jenisChanged()">
                                        <option></option>
                                        <option value="voucher" <?= set_value('jenis') == 'voucher' ? 'selected' : '' ?>>Voucher</option>
                                        <option value="tukar_barang" <?= set_value('jenis') == 'tukar_barang' ? 'selected' : '' ?>>Tukar Barang</option>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('jenis') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="stokDiv" style="display: none;">
                                    <label for="stok" class="form-label">Stok Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="stok" name="stok" value="<?= set_value('stok') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('stok') ?></span>
                                </div>
                                <div class="col-12 mb-3" id="divNominal" style="display: none;">
                                    <label for="nominal" class="form-label">Harga Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nominal" name="nominal" value="<?= set_value('nominal') ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nominal') ?></span>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="poin" class="form-label">Poin Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="poin" name="poin" value="<?= set_value('poin') ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('poin') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="on_thumb" class="form-label">Tampilkan di Thumbnail <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="on_thumb" name="on_thumb" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <option value="1" <?= set_value('on_thumb') == '1' ? 'selected' : '' ?>>Ya</option>
                                        <option value="0" <?= set_value('on_thumb') == '0' ? 'selected' : '' ?>>Tidak</option>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('on_thumb') ?></span>
                                </div>

                            </div>
                            <div class="col-12 mb-3 modal-footer">
                                <button type="submit" name="btnBack" class="btn btn-secondary me-2 mb-3">Kembali</button>
                                <button type="submit" name="btnAdd" class="btn btn-primary me-2 mb-3">Tambah</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>