<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Ulasan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url('nasabah/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item">Edit Ulasan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-center">Edit Ulasan</p>
                        <form action="<?= base_url('nasabah/ulasan/edit') ?>" method="post">
                            <div class="col-12 mb-3">
                                <label class="form-label">Rating </label>
                                <div class="star-rating">
                                    <?php for ($i = $maxRating; $i >= 1; $i--) : ?>
                                        <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php echo ($i == $ulasan['rating_review']) ? 'checked' : ''; ?>>
                                        <label for="star<?php echo $i; ?>"></label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ulasan" class="form-label">Ulasan <i class="text-danger">*</i><span id="rangeValue"></span> </label>
                                <textarea class="form-control" style="height: 100px" name="ulasan" placeholder="..."><?= $ulasan['deskripsi_review'] ?></textarea>
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('ulasan') ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="<?= base_url('nasabah/ulasan/') ?>delete/<?= $ulasan['id_review'] ?>" class="btn btn-danger tmbol-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Ulasan"><i class="bi bi-trash"></i></a>
                                <button type="submit" name="btnAdd" class="btn btn-primary">Edit Ulasan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

</main>

<script>
    // var rangeInput = document.getElementById("customRange2");
    // var rangeValue = document.getElementById("rangeValue");

    // // Fungsi untuk memperbarui tampilan nilai saat range diubah
    // rangeInput.addEventListener("input", function() {
    //     rangeValue.innerHTML = rangeInput.value;
    // });
</script>