<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
        <form action="<?= site_url('Home/SignIn') ?>" method="post">
            <div class="modal-body">
                <div class="mb-4 mt-3 text-center">
                    <div>
                      <img src="<?= base_url('assets/img/avatars/default-avatar.png') ?>" width="48" height="48" alt="Bootstrap">
                    </div> 
                    <br>
                    <h3>Stockism</h3>
                </div>
                
                <div class="mb-3 form-group required">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control form-control-lg" name="email_user" required>
                </div>
                <div class="mb-3 form-group required">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control form-control-lg" name="password" required>
                </div>
                <a href="<?= site_url('Home/ForgotPassword'); ?>" class="btn btn-sm btn-pill btn-link">Forgot Password</a>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button class="btn bg-stockism text-white btn-lg btn-pill" type="submit">Masuk!</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>