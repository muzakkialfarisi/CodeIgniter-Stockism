<div class="modal fade" id="ModalEdit" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Stores/EditPost') ?>" method="post">
                <?php echo validation_errors(); ?>
            
                <div class="modal-body m-3">
                    <div class="row">
                        <input type="text" class="form-control" name="id_toko" required hidden>
                        <input type="text" class="form-control" name="email_tenant" required hidden>
                        <div class="col-12 col-sm-6 required">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group required">
                                <label class="control-label">Item</label>
                                <div class="input-group">
                                    <select class="form-select flex-grow-1" name="id_marketplace">
                                    <?php foreach($masmarketplace as $item) { ?>
                                        <tr>
                                            <option><?= $item['name'] ?></option>
                                        </tr>
                                    <?php } ?>	
                                    </select>
                                    <button class="btn bg-stockism text-light" type="button">Add!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="control-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="control-label">Komisi</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="komisi">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Picture</label>
                                <input type="file" class="form-control" name="picture">
                                <small class="form-text d-block text-muted">Max 500 kb.</small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="<?= base_url(); ?>assets/img/stores/default-store.png" class="img-thumbnail" height="60" width="60" asp-append-version="true"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn bg-stockism text-light btn-pill" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>