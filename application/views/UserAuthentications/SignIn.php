<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
        <form action="Home">
            <div class="modal-body">
                <div class="mb-4 mt-3 text-center">
                    <div>
                      <img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap">
                    </div> 
                    <br>
                    <h3>Stockism</h3>
                </div>
                
                <div class="mb-3 form-group required">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control form-control-lg">
                </div>
                <div class="mb-3 form-group required">
                    <label class="control-label">Kata Sandi</label>
                    <input type="password" class="form-control form-control-lg">
                </div>
                <a href="<?= site_url('Home/ForgotPassword'); ?>" class="btn btn-sm btn-pill btn-link">Lupa Kata Sandi</a>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <a class="btn bg-stockism text-white btn-lg btn-pill" href="<?= site_url('Home/SignIn'); ?>">Masuk!</a>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>