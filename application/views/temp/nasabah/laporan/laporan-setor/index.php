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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filter Tanggal</h5>

                        <form action="<?= base_url('nasabah/laporan_setor/index') ?>" method="GET">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="startdate">
                                <span class="input-group-text">s/d</span>
                                <input type="date" class="form-control" name="enddate">
                            </div>

                            <button type="submit" name="tampil" class="btn btn-primary mb-2"><i class="bi bi-search"></i> Tampil</button>
                        </form>
                        <?php if (isset($_GET['tampil'])) : ?>
                            <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">
                                <div class="dataTable-container">
                                    <p class="text-center card-title" style="font-size: 20px;">Riwayat Setor Sampah</p>
                                    <label>Periode : <?php echo $label ?></label>
                                    <table class="table datatable dataTable-table mt-2" style="font-size: 15px;">
                                        <thead style="background-color: #F6F6FE;">
                                            <tr>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class=" disable">No</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">ID </a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Tanggal</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Jenis Sampah</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Poin</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Berat</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Total Poin</a>
                                                </th>
                                                <th class="text-center" scope="col" data-sortable>
                                                    <a href="#" class="">Status</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($setors)) : ?>
                                                <tr>
                                                    <td colspan="9" class="text-center text-danger"><?= "Tidak Ada Data" ?></td>
                                                </tr>
                                            <?php else : ?>
                                                <?php $no = 1;
                                                foreach ($setors as $rows) : ?>
                                                    <tr>
                                                        <th scope="row" class="text-center"><?= $no++ ?></th>
                                                        <td><?= $rows['id_setor'] ?></td>
                                                        <td><?= date('d-m-Y H:i:s', $rows['date_setor']) ?></td>
                                                        <td><?= ucwords($rows['nama_sampah_setor']) ?></td>
                                                        <td><?= number_format($rows['poin_sampah_setor']) ?></td>
                                                        <td><?= number_format($rows['berat_setor'], 2, '.', '') ?></td>
                                                        <td><?= number_format($rows['poin_total']) ?></td>
                                                        <td>
                                                            <?php if ($rows['status_setor'] == '0') : ?>
                                                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?= ucwords('failed') ?></span>
                                                            <?php elseif ($rows['status_setor'] == '1') : ?>
                                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> <?= ucwords('success') ?></span>
                                                            <?php elseif ($rows['status_setor'] == '2') : ?>
                                                                <span class="badge bg-warning"><i class="bi bi-info-circle me-1"></i> <?= ucwords('pending') ?></span>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>