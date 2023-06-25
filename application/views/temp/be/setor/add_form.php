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

                        <form action="<?= base_url('imadmin/setor/') ?>add" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Nasabah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="nama" name="nama" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <?php foreach ($nasabahs as $row) : ?>
                                            <option value="<?= $row['id_nasabah'] ?>" <?= set_value('nama') == $row['id_nasabah'] ? 'selected' : '' ?>><?= $row['username'] ?> - <?= ucwords($row['nama_nasabah']) ?></option>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="detail_nas" style="display: none;">
                                    <label for="#" class="form-label fw-bold">Detail Nasabah</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Kode Nasabah</label>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7" id="userNas"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Nama Nasabah</label>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7" id="namaNas"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Alamat Nasabah</label>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-7" id="alamatNas"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="jenis" class="form-label">Jenis Sampah <i class="text-danger">*</i></label>
                                    <select class="mySelect2 form-control" id="jenis" name="jenis" data-placeholder="~ Pilih ~">
                                        <option></option>
                                        <?php foreach ($sampahs as $row) : ?>
                                            <?php if ($row['status_sampah'] == '1') : ?>
                                                <option value="<?= $row['id_sampah'] ?>" <?= set_value('jenis') == $row['id_sampah'] ? 'selected' : '' ?>><?= $row['kode_sampah_kat'] ?> - <?= ucwords($row['nama_sampah']) ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('jenis') ?></span>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="poin" class="form-label">Poin Sampah <i class="text-danger" style="font-size: 12px;">(Otomatis Terisi)</i></label>
                                    <input type="text" class="form-control" style="background-color: rgba(0,0,0,0.1);" id="poin" name="poin" value="<?= set_value('poin') ?>" readonly placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('poin') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="divBerat" style="display: none;">
                                    <label for="berat" class="form-label">Berat Sampah (kg) <i class="text-danger">*</i></label>
                                    <input type="number" class="form-control" step="0.01" min="0.01" max="9999.99" id="berat" name="berat" value="<?= set_value('berat') ?>" placeholder="..." oninput="jumBerat()">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('berat') ?></span>
                                </div>

                                <div class="col-12 mb-3" id="divTotal" style="display: none;">
                                    <label for="total" class="form-label">Total Poin <i class="text-danger" style="font-size: 12px;">(Otomatis Terisi)</i></label>
                                    <input type="number" class="form-control" style="background-color: rgba(0,0,0,0.1);" id="total" name="total" value="<?= set_value('total') ?>" readonly placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('total') ?></span>
                                </div>

                            </div>
                            <div class="col-12 mb-3 modal-footer">
                                <button type="submit" name="btnBack" class="btn btn-secondary me-2 mb-3">Kembali</button>
                                <button type="submit" name="btnAdd" class="btn btn-primary me-2 mb-3">Setor</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    // Menggunakan jQuery untuk memudahkan AJAX
    $(document).ready(function() {
        // Menggunakan event listener change pada select option
        $('#nama').change(function() {
            var idNasabah = $(this).val(); // Mengambil nilai value dari select option
            var divDetail = document.getElementById('detail_nas');

            // Mengirim permintaan AJAX ke server
            $.ajax({
                url: '<?php echo base_url('imadmin/setor/get_nasabah_detail'); ?>', // Ganti mycontroller dengan nama controller Anda
                type: 'POST',
                data: {
                    id_nasabah: idNasabah
                }, // Kirim data id nasabah
                dataType: 'json',
                success: function(response) {
                    // Mengisi nilai input text dengan data yang diterima dari server
                    $('#userNas').text(response.username);
                    $('#namaNas').text(response.nama_nasabah);
                    $('#alamatNas').text(response.alamat + ' Rt. ' + response.alamat_rt + ' Rw. ' + response.alamat_rw);

                    divDetail.style.display = "block";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Menampilkan pesan error jika terjadi kesalahan
                }
            });
        });
    });
    $(document).ready(function() {
        // Menggunakan event listener change pada select option
        $('#jenis').change(function() {
            var idSampah = $(this).val(); // Mengambil nilai value dari select option
            var divBerat = document.getElementById('divBerat');
            var divTotal = document.getElementById('divTotal');

            // Mengirim permintaan AJAX ke server
            $.ajax({
                url: '<?php echo base_url('imadmin/setor/get_sampah_detail'); ?>', // Ganti mycontroller dengan nama controller Anda
                type: 'POST',
                data: {
                    id_sampah: idSampah
                }, // Kirim data id nasabah
                dataType: 'json',
                success: function(response) {
                    // Mengisi nilai input text dengan data yang diterima dari server
                    $('#poin').val(response.poin_sampah);

                    divBerat.style.display = "block";
                    divTotal.style.display = "block";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Menampilkan pesan error jika terjadi kesalahan
                }
            });
        });
    });

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