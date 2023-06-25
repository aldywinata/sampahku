    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span><?= ucwords($info['nama_sysfo']) ?></span></strong> - <?= date('Y') ?>
        </div>
        <div class="credits">
            Designed by <a href="#"><?= ucwords($info['nama_sysfo']) ?></a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <!-- Mengirim URL base_url() -->
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <!-- Vendor JS Files -->
    <!-- <script src="<?= base_url(); ?>assets/js/be/jquery-3.6.3.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/be/myjs.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap-toggle/js/bootstrap5-toggle.ecmas.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/vendor/bootstrap-toggle/js/bootstrap5-toggle.jquery.min.js"></script> -->
    <script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>assets/vendor/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/select2/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/js/be/main.js"></script>

    <script>
        <?php if (isset($_SESSION['notif']) && $_SESSION['notif'] !== '') : ?>
            Swal.fire({
                icon: "<?php echo $_SESSION['notif']['icon']; ?>",
                title: "<?php echo $_SESSION['notif']['title']; ?>",
                text: "<?php echo $_SESSION['notif']['message']; ?>",
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['notifTimer']) && $_SESSION['notifTimer'] !== '') : ?>
            Swal.fire({
                position: 'top-end',
                icon: "<?php echo $_SESSION['notifTimer']['icon']; ?>",
                title: "<?php echo $_SESSION['notifTimer']['title']; ?>",
                text: "<?php echo $_SESSION['notifTimer']['message']; ?>",
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    </script>
    <script>
        var quill_desk = new Quill('#desk-Quill', {
            theme: 'snow'
        });
        quill_desk.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='desk']").value = quill_desk.root.innerHTML;
        });
    </script>

    </body>

    </html>