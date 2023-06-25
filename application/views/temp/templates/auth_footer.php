    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>assets/js/be/jquery-3.6.3.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/be/myjs.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>assets/js/be/main.js"></script>

    <script>
        $('.time').delay(5000).fadeOut(300);
    </script>

    <script>
        <?php if(isset($_SESSION['notif']) && $_SESSION['notif'] !== ''): ?>
            Swal.fire({
                icon: "<?php echo $_SESSION['notif']['icon']; ?>",
                title: "<?php echo $_SESSION['notif']['title']; ?>",
                text: "<?php echo $_SESSION['notif']['message']; ?>",
            });
        <?php endif; ?>
    </script>

</body>

</html>