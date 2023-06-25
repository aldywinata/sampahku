<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/sampah') ?>">Data Sampah</a></li>
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

                        <form action="<?= base_url('imadmin/sampah/') ?>add" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label">Foto <i class="text-danger">*</i></label>
                                    <input class="form-control" type="file" name="foto" id="foto" accept=".png, .jpeg, .jpg" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('foto') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="kode" class="form-label">Kode Sampah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="kode" name="kode" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <?php foreach ($sampah_kats as $kat) : ?>
                                            <?php if ($kat['status_sampah_kat'] == '1') : ?>
                                                <option value="<?= $kat['id_sampah_kat'] ?>" <?= set_select('kode', $kat['id_sampah_kat'], set_value('kode') == $kat['id_sampah_kat']) ?>>
                                                    - <?= strtoupper($kat['kode_sampah_kat']) . ' - ' . ucwords($kat['nama_sampah_kat']) ?>
                                                </option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('kode') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Sampah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="satuan" class="form-label">Jenis Satuan Sampah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?= set_value('satuan') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('satuan') ?></span>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="poin" class="form-label">Poin Sampah <i class="text-danger">*</i></label>
                                    <!-- <input type="number" class="form-control" id="poin" name="poin" value="<?= set_value('poin') ?>" placeholder="..."> -->
                                    <input type="text" class="form-control" id="poin" name="poin" value="<?= set_value('poin') ?>" placeholder="..." oninput="formatInput()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('poin') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="desk" class="form-label">Deskripsi Sampah <i class="text-danger">*</i></label>
                                    <input type="hidden" name="desk" value="<?= set_value('desk') ?>">
                                    <div id="desk-Quill" style="min-height: 125px;"><?= set_value('desk') ?></div>
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('desk') ?></span>
                                </div>

                            </div>
                            <div class="col-12 mb-3 modal-footer">
                                <a href="<?= base_url('imadmin/sampah'); ?>"><button type="button" class="btn btn-secondary me-2 mb-3" data-bs-dismiss="modal">Kembali</button></a>
                                <button type="submit" class="btn btn-primary me-2 mb-3">Tambah</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>