<section class="py-6">
    <div class="container">
        <div class="mb-5 text-center">
            <h2>Reset Password</h2>
        </div>
        <form action="<?= site_url('Home/ResetPasswordPost') ?>" method="post">
            <div class="row pb-3 d-flex justify-content-center">
                <div class="col-12 col-sm-6 px-5">
                    <input type="email" class="form-control" name="email_user" value="<?= $email ?>" hidden required>
                    <div class="mb-3 form-group required">
                        <label class="control-label">New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Verify Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                    <div class="text-end">
                        <button class="btn bg-stockism text-white btn-lg btn-pill" type="submit">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>