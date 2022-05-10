<div class="modal fade" id="ModalCreate" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Stores/AddStoreProcess') ?>" method="post">
                <?php echo validation_errors(); ?>
            
                <div class="modal-body m-3">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group required">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Marketplace</label>
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
                                <label class="btn bg-stockism text-light">%</label>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Picture</label>
                                <input type="file" class="form-control" name="photo">
                                <small class="form-text d-block text-muted">Max 500 kb.</small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <img src="<?= base_url(); ?>/img/stores/default-store.png" class="img-thumbnail" height="60" width="60" asp-append-version="true"/>
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