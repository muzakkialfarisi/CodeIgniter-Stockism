<div class="modal fade" id="ModalCreate" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Employees/CreatePost') ?>" method="post" enctype="multipart/form-data">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <div class="mb-3 form-group required">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="control-label">Whatsapp Number</label>
                            <input type="text" class="form-control" placeholder="08xxxxxxxxx" name="phone_number">
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group required">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control form-control" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="control-label">Address</label>
                        <textarea class="form-control" rows="3" name="address" value=""></textarea>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Picture</label>
                                <input accept="image/*" type="file" class="form-control" name="picture">
                                <span class="font-13 text-muted">Max 1 MB</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="<?= base_url(); ?>/assets/img/avatars/default-avatar.png" class="img-thumbnail picture_preview" height="60" width="60" asp-append-version="true"/>
                        </div>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button class="btn bg-stockism text-white btn-lg btn-pill" type="submit">Save</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>