<section class="py-6">
    <div class="container-fluid">
        <div class="mb-5 text-center">
            <h2>Bergabunglah bersama kami!</h2>
        </div>
        <form action="<?= site_url('Home/SignUpProcess') ?>" method="post">
            <?php echo validation_errors(); ?>
            <div class="row pb-3">
                <div class="col-12 col-sm-6 px-5">
                    <div class="mb-3 form-group required">
                        <label class="control-label">Nama</label>
                        <input type="text" class="form-control form-control-lg" name="name" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email_user" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Nomor Whatsapp</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">+62</span>
                            <input type="text" class="form-control" placeholder="80123456789" name="phone_number" required>
                        </div>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Kata Sandi</label>
                        <input type="password" class="form-control form-control-lg" name="password" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control form-control-lg" name="password_confirmed" required> 
                    </div>
                    <div class="text-end">
                        <button class="btn bg-stockism text-white btn-lg btn-pill" type="submit">Simpan</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 px-5">
                    <a class="mb-3 card overflow-hidden">
                        <div class="px-4 pt-4">
                            <img src="<?= base_url('assets/img/avatars/default-avatar.png')?>" class="img-fluid card-img-hover landing-img" alt="Modern Bootstrap 5 Dashboard Theme">
                        </div>
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>