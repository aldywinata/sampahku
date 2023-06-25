<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<main>
	<div class="container">
		<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
			<img src="<?= base_url('assets/') ?>imgs/img/page-404.gif" class="img-fluid" alt="Not Found !">

			<p class="fs-5 text-black text-center">Halaman tidak ditemukan. <br>
				Anda akan diarahkan dalam waktu <span id="countdown" class="text-danger"><?php echo $countdown; ?></span> detik...</p>

		</section>
	</div>
</main>

<script>
	var countdown = <?php echo $countdown; ?>; // Mengambil nilai waktu mundur dari controller

	function redirect() {
		if (countdown > 0) {
			countdown--;
			document.getElementById('countdown').innerHTML = countdown;
			setTimeout(redirect, 1000);
		} else {
			<?php if ($id == '0') : ?>
				window.location.href = '<?php echo base_url('imadmin/dashboard'); ?>'; // Jika login admin/petugas
			<?php elseif ($id == '1') : ?>
				window.location.href = '<?php echo base_url('nasabah/dashboard'); ?>'; // Jika login nasabah
			<?php else : ?>
				window.location.href = '<?php echo base_url(); ?>'; // jika belum login
			<?php endif ?>

		}
	}

	window.onload = function() {
		redirect();
	};
</script>