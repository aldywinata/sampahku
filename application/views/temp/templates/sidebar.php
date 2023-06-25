<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Home</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <?php if ($this->session->userdata('id_users') != '2') : ?>

            <li class="nav-heading">Transaksi</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>setor">
                    <i class="bi bi-check2-circle"></i>
                    <span>Setor Sampah</span>
                </a>
            </li><!-- End Data Menu Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>penukaran">
                    <i class="bi bi-people"></i>
                    <span>Penukaran Poin <?= ($jumProses > 0) ? '<span class="badge bg-danger text-white">' . $jumProses . '</span>' : '' ?> </span>
                </a>
            </li><!-- End Data Menu Nav -->
        <?php endif ?>

        <?php if ($this->session->userdata('id_users') != '2') : ?>
            <li class="nav-heading">Data</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>nasabah">
                    <i class="bi bi-people"></i>
                    <span>Data Nasabah</span>
                </a>
            </li><!-- End Data Menu Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>sampah">
                    <i class="bi bi-people"></i>
                    <span>Data Sampah</span>
                </a>
            </li><!-- End Data Menu Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>hadiah">
                    <i class="bi bi-people"></i>
                    <span>Data Hadiah</span>
                </a>
            </li><!-- End Data Menu Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('imadmin/') ?>review">
                    <i class="bi bi-people"></i>
                    <span>Data Review Nasabah</span>
                </a>
            </li><!-- End Data Menu Nav -->

        <?php endif ?>
        <?php if ($this->session->userdata('id_users') == '1') : ?>
            <li class="nav-heading">Management</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#management-data" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Management Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="management-data" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= base_url('imadmin/') ?>users">
                            <i class="bi bi-circle"></i><span>Data Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('imadmin/') ?>kategori">
                            <i class="bi bi-circle"></i><span>Data Kategori Sampah</span>
                        </a>
                    </li>
                </ul>
            </li>

        <?php endif ?>
        <?php if ($this->session->userdata('id_users') != '2') : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#management-sistem" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Management Sistem</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="management-sistem" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <?php if ($this->session->userdata('id_users') == '1') : ?>
                        <li>
                            <a href="<?= base_url('imadmin/') ?>config">
                                <i class="bi bi-circle"></i><span>Config Sistem</span>
                            </a>
                        </li>
                    <?php endif ?>
                    <!-- <li>
                    <a href="<?= base_url('imadmin/') ?>dokumentasi">
                        <i class="bi bi-circle"></i><span>Dokumentasi</span>
                    </a>
                </li> -->
                    <li>
                        <a href="<?= base_url('imadmin/') ?>partner">
                            <i class="bi bi-circle"></i><span>Partner</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>
        <li class="nav-heading">DATABASE</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#laporan" data-bs-toggle="collapse" href="#">
                <i class="bi bi-printer"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="laporan" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('imadmin/') ?>laporan-setor">
                        <i class="bi bi-circle"></i><span>Laporan Setor Sampah</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('imadmin/') ?>laporan-penukaran">
                        <i class="bi bi-circle"></i><span>Laporan Penukaran Poin</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside><!-- End Sidebar-->