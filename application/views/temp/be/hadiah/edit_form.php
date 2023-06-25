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

                        <form action="<?= base_url('imadmin/hadiah/') ?>edit" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label">Foto <i class="text-danger">(opsional)</i></label>
                                    <div class="col">
                                        <img src="<?= base_url() ?>assets/imgs/be/img-reward/<?= $row['img_reward'] ?>" style="height: 200px;" alt="Foto">
                                        <div class="pt-2">
                                            <div class="fileUpload btn btn-primary btn-sm">
                                                <i class="bi bi-upload"></i>
                                                <input type="file" class="upload" accept=".png, .jpeg, .jpg" name="foto" />
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('foto') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="jenis" class="form-label">Jenis Hadiah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="jenis" name="jenis" data-placeholder="~ Pilih ~" onchange="jenisChangedEdit()">
                                        <option></option>
                                        <?php foreach ($jeniss as $jenis) : ?>
                                            <?php if ($row['jenis_reward'] == $jenis) : ?>
                                                <option value="<?= $jenis ?>" <?= set_select('jenis', $jenis, set_value('jenis') == $row['jenis_reward']) ?> selected>
                                                    <?= $jenis ?>
                                                </option>
                                            <?php else : ?>
                                                <option value="<?= $jenis ?>" <?= set_select('jenis', $jenis, set_value('jenis') == $row['jenis_reward']) ?>>
                                                    <?= $jenis ?>
                                                </option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('jenis') ?></span>
                                </div>
                                <?php if ($row['jenis_reward'] == 'tukar_barang') {
                                    $display = 'display: blok;';
                                } elseif ($row['jenis_reward'] == 'voucher') {
                                    $display = 'display: none;';
                                } ?>
                                <div class="col-12 mb-3" id="stokDiv" style="<?= $display ?>">
                                    <label for="stok" class="form-label">Stok Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="stok" name="stok" value="<?= $row['stok_reward'] ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('stok') ?></span>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= ucwords($row['nama_reward']) ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="poin" class="form-label">Poin Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="poin" name="poin" value="<?= $row['poin_reward'] ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('poin') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="nominal" class="form-label">Harga Hadiah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nominal" name="nominal" value="<?= $row['nominal_reward'] ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nominal') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="on_thumb" class="form-label">Tampilkan di Thumbnail <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="on_thumb" name="on_thumb" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <?php foreach ($ons as $on) : ?>
                                            <?php if ($row['on_thumbnail'] == $on) : ?>
                                                <option value="1" <?= set_select('on_thumb', 1, set_value('on_thumb') == $row['on_thumbnail']) ?> selected>
                                                    Ya
                                                </option>
                                            <?php else : ?>
                                                <option value="0" <?= set_select('on_thumb', 0, set_value('on_thumb') == $row['on_thumbnail']) ?> selected>
                                                    Tidak
                                                </option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('on_thumb') ?></span>
                                </div>
                                <input type="hidden" name="kd" value="<?= $row['kode_reward'] ?>">
                                <input type="hidden" name="img_old" value="<?= $row['img_reward'] ?>">
                            </div>
                            <div class="col-12 mb-3 modal-footer">
                                <button type="submit" name="btnBack" class="btn btn-secondary me-2 mb-3">Kembali</button>
                                <button type="submit" name="btnAdd" class="btn btn-primary me-2 mb-3">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>