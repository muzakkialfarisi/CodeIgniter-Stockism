<section class="py-6">
    <div class="container">
        <div class="mb-5 text-center">
            <h2>Lupa Kata Sandi?</h2>
            <p class="text-muted">Kirim Permintaan Atur Ulang Kata Sandi!</p>
        </div>
        <form action="<?= site_url('Home/ForgotPasswordPost') ?>" method="post">
            <div class="row pb-3 d-flex justify-content-center">
                <div class="col-12 col-sm-6 px-5">
                    <div class="mb-3 form-group required">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email_user" required>
                    </div>

                    <div class="text-end">
                        <button class="btn bg-stockism text-white btn-lg btn-pill" type="submit">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>