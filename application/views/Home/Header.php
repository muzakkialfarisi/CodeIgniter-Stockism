<nav class="navbar navbar-expand navbar-dark absolute-top w-100 py-2">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= current_url(); ?>">
            <svg>
                <use xlink:href="#ion-ios-pulse-strong"></use>
            </svg>
            Stockism
        </a>
        <button type="button" class="btn btn-light btn-lg btn-pill" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
            Masuk
        </button>
    </div>
</nav>

<section class="bg-stockism text-white overflow-hidden">
    <div class="container py-4">
        <div class="row">
            <div class="col-xl-11 mx-auto">
                <div class="row">
                    <div class="col-md-12 col-xl-8 text-center mx-auto">
                        <div class="d-block my-4">
                            <h1 class="display-4 fw-bold mb-3 text-white">Stockism</h1>
                            <p class="lead fw-light mb-3 landing-text">
                                Tingkatkan omset penjualan tanpa harus bingung kelola stok barang dagangan hanya dengan satu sistem!
                            </p>
                            <a href="<?= site_url('Home/SignUp') ?>" class="btn-link text-white">Daftar Sekarang!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="py-3 bg-white landing-nav">
    <?php if($content == "Home/MainBody") { ?>
        <div class="container text-center">
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-pill btn-link text-dark">Home</a>
            <a href="#AboutUs" class="btn btn-lg btn-pill btn-link text-dark">Tentang Kami</a>
            <a href="#Help" class="btn btn-lg btn-pill btn-link text-dark">Bantuan</a>
            <a href="#ContactUs" class="btn btn-lg btn-pill btn-link text-dark">Hubungi Kami</a>
        </div>
    <?php } else { ?>
        <div class="container text-center">
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-pill btn-link text-dark">Home</a>
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-pill btn-link text-dark">Tentang Kami</a>
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-pill btn-link text-dark">Bantuan</a>
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-pill btn-link text-dark">Hubungi Kami</a>
        </div>
    <?php } ?>
</div>