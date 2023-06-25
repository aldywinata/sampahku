<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data <?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('imadmin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data <?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data <?= $title ?></h5>

                        <div class="col-lg-4 mb-3">
                            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                                <li class="nav-item flex-fill " role="presentation">
                                    <button class="nav-link w-100 text-success active" id="aktif-tab" data-bs-toggle="tab" data-bs-target="#tab-aktif" type="button" role="tab" aria-controls="aktif" aria-selected="true">Aktif</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100 text-danger" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tab-konfirmasi" type="button" role="tab" aria-controls="konfirmasi" aria-selected="false">Konfirmasi <?php echo ($jumStat > '0') ? '<span class="badge bg-danger text-white">' . number_format($jumStat) . '</span>' : '' ?></button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="tab-aktif" role="tabpanel" aria-labelledby="aktif-tab">
                                <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">

                                    <div class="dataTable-container">
                                        <table class="table datatable dataTable-table" style="font-size: 15px;" id="dataTables">
                                            <thead style="background-color: #F6F6FE;">
                                                <tr>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class=" disable">No</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Foto</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Nama Nasabah</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Review</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Status</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($reviews as $rows) : ?>
                                                    <?php if ($rows['status_review'] == '1') : ?>
                                                        <tr>
                                                            <th scope="row" class="text-center"><?= $no++ ?></th>
                                                            <td>
                                                                <img src="<?= base_url('assets/imgs/be/img-nasabah/' . $rows['img_nasabah']) ?>" class="img-size rounded" alt="">
                                                            </td>
                                                            <td><?= ucwords($rows['nama_nasabah']) ?></td>
                                                            <td>
                                                                <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_review'] ?>"><i class="bi bi-check2-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Review"> Lihat</i></a>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $rows['id_review']; ?>', 'imadmin/review/updateStatus')" <?= ($rows['status_review'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade show" id="tab-konfirmasi" role="tabpanel" aria-labelledby="konfirmasi-tab">
                                <div class="dataTable-wrapper dataTable-loading sortable searchable fixed-columns search-result mt-1">

                                    <div class="dataTable-container">
                                        <table class="table datatable dataTable-table" style="font-size: 15px;" id="dataTables2">
                                            <thead style="background-color: #F6F6FE;">
                                                <tr>
                                                    <th class="text-center" scope="col" data-sortable>
                                                        <a href="#" class=" disable">No</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Foto</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Nama Nasabah</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Review</a>
                                                    </th>
                                                    <th scope="col" data-sortable>
                                                        <a href="#" class="">Status</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($reviews as $rows) : ?>
                                                    <?php if ($rows['status_review'] == '0') : ?>
                                                        <tr>
                                                            <th scope="row" class="text-center"><?= $no++ ?></th>
                                                            <td>
                                                                <img src="<?= base_url('assets/imgs/be/img-nasabah/' . $rows['img_nasabah']) ?>" class="img-size rounded" alt="">
                                                            </td>
                                                            <td><?= ucwords($rows['nama_nasabah']) ?></td>
                                                            <td><a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalView<?= $rows['id_review'] ?>"><i class="bi bi-check2-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Review"> Lihat</i></a></td>
                                                            <td class="text-center">
                                                                <input type="checkbox" id="ubahStat" onchange="toggleStatus('<?php echo $rows['id_review']; ?>', 'imadmin/review/updateStatus')" <?= ($rows['status_review'] == '1') ? 'checked' : '' ?> data-toggle="toggle" data-size="sm" data-width="90" data-style="slow" data-onlabel="<span style='font-size: 13px'>Aktif</span>" data-offlabel="<span style='font-size: 13px'>Tidak Aktif</span>" data-onstyle="primary" data-offstyle="danger">
                                                            </td>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php foreach ($reviews as $row) : ?>
    <div class="modal fade" id="modalView<?= $row['id_review'] ?>" tabindex="-1">
        <div class="modal-dialog" style="width: 25rem;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <div class="star-rating">
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <span class="star <?php echo ($i <= $row['rating_review']) ? 'filled' : 'empty'; ?>"></span>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 mt-3 text-center">
                            <?= $row['deskripsi_review'] ?>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-5">
                        <img src="<?= base_url('assets/imgs/be/img-nasabah/' . $row['img_nasabah']) ?>" style="width: 100px; height: 100px; border-radius: 100%;" class="img-fluid" alt="">
                        <h3 class="card-title text-center"><?= ucwords($row['nama_nasabah']) ?></h3>
                        <span class="text-center text-secondary"><?= ucwords($row['pekerjaan_nasabah']) ?></span>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>