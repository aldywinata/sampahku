<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/hadiah') ?>">Setor Sampah</a></li>
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

                        <form action="<?= base_url('imadmin/setor/') ?>update" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Nasabah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="nama" name="nama" data-placeholder="~ Pilih ~" disabled>
                                        <option></option>
                                        <?php foreach ($nasabahs as $row) : ?>
                                            <?php if ($setor['id_nasabah'] == $row['id_nasabah']) : ?>
                                                <option value="<?= $row['id_nasabah'] ?>" <?= $setor['id_nasabah'] == $row['id_nasabah'] ? 'selected' : '' ?>><?= $row['username'] ?> - <?= ucwords($row['nama_nasabah']) ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="stat" class="form-label">Status Setor <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="stat" name="stat" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <?php foreach ($stats as $value) : ?>
                                            <option value="<?= $value ?>" <?= ($setor['status_setor'] == $value) ? 'selected' : '' ?>>
                                                <?= ($value == 0) ? 'Failed' : (($value == 1) ? 'Success' : 'Pending') ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('stat') ?></span>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="jenis" class="form-label">Jenis Sampah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="jenis" name="jenis" data-placeholder="~ Pilih ~" disabled>
                                        <option></option>
                                        <?php foreach ($sampahs as $row) : ?>
                                            <option value="<?= $row['id_sampah'] ?>" <?= $setor['nama_sampah_setor'] == $row['nama_sampah'] ? 'selected' : '' ?>><?= $row['kode_sampah_kat'] ?> - <?= ucwords($row['nama_sampah']) ?></option>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('jenis') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="poin" class="form-label">Poin Sampah <i class="text-danger" style="font-size: 12px;">(Otomatis Terisi)</i></label>
                                    <input type="text" class="form-control" style="background-color: rgba(0,0,0,0.1);" id="poin" name="poin" value="<?= $setor['poin_sampah_setor'] ?>" readonly placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('poin') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="divBerat">
                                    <label for="berat" class="form-label">Berat Sampah <i class="text-danger">*</i></label>
                                    <input type="number" class="form-control" step="0.01" min="0.01" max="9999.99" id="berat" name="berat" value="<?= $setor['berat_setor'] ?>" placeholder="..." oninput="jumBerat()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('berat') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="divTotal">
                                    <label for="total" class="form-label">Total Poin <i class="text-danger" style="font-size: 12px;">(Otomatis Terisi)</i></label>
                                    <input type="number" class="form-control" style="background-color: rgba(0,0,0,0.1);" id="total" name="total" value="<?= $setor['poin_total'] ?>" readonly placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('total') ?></span>
                                </div>

                                <input type="hidden" name="ids" value="<?= $setor['id_setor'] ?>">
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
<script>
    // hitung poin total setor
    function jumBerat() {
        var poin = parseInt(document.getElementById('poin').value);
        var berat = parseFloat(document.getElementById('berat').value);
        // var berat_bulat = Math.round(berat);
        var total = berat * poin;

        if (isNaN(total)) {
            total = 0;
        }

        if (isNaN(berat) || berat < 0.01 || berat > 9999.99) {
            berat.setCustomValidity('Please enter a valid value between 0.01 and 9999.99.');
        }

        document.getElementById('total').value = total;
        berat.required = true;
    }
</script>