<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url('nasabah/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mt-2">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-center">Beri Ulasan</p>
                        <form action="<?= base_url('nasabah/ulasan/add') ?>" method="post">
                            <div class="col-12 mb-3">
                                <label class="form-label">Rating </label>
                                <div class="star-rating">
                                    <input type="radio" id="star5" name="rating" value="5" checked>
                                    <label for="star5"></label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4"></label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3"></label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2"></label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1"></label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ulasan" class="form-label">Ulasan <i class="text-danger">*</i><span id="rangeValue"></span> </label>
                                <textarea class="form-control" style="height: 100px" name="ulasan" placeholder="..."><?= set_value('ulasan') ?></textarea>
                                <span class="text-danger" style="font-size: 15px;"><?= form_error('ulasan') ?></span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
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