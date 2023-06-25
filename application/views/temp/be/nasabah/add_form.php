<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/nasabah') ?>">Data Nasabah</a></li>
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

                        <form action="<?= base_url('imadmin/nasabah/') ?>add" class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="nama" class="form-label">Nama Nasabah <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('nama') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="#" class="form-label">Alamat <i class="text-danger">*</i></label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <textarea class="form-control" style="height: 40px" name="alamat" placeholder="Jl/Kp.."><?= set_value('alamat') ?></textarea>
                                            <span class="text-danger" style="font-size: 15px;"><?= form_error('alamat') ?></span>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="rw" name="rw" value="<?= set_value('rw') ?>" placeholder="RW">
                                            <span class="text-danger" style="font-size: 13px;"><?= form_error('rw') ?></span>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="rt" name="rt" value="<?= set_value('rt') ?>" placeholder="RT">
                                            <span class="text-danger" style="font-size: 13px;"><?= form_error('rt') ?></span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6">

                                <div class="col-12 mb-3">
                                    <label for="job" class="form-label">Pekerjaan <span class="text-danger"></span></label>
                                    <input type="job" class="form-control" id="job" name="job" value="<?= set_value('job') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('job') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger" style="font-size: 13px;">*(gunakan email active)</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" placeholder="...">
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('email') ?></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="no_hp" class="form-label">No WhatsApp <i class="text-danger">*</i></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= set_value('no_hp') ?>" placeholder="8123xxx" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="text-danger" style="font-size: 15px;"><?= form_error('no_hp') ?></span>
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