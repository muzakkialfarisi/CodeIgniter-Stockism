<div class="modal fade" id="Modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Stores/AddStoreProcess') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <div class="mb-3 form-group required">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Marketplace</label>
                        <select class="form-control mb-3" name="id_marketplace" required>
                            <?php foreach($masmarketplace as $item) { ?>
                                <tr>
                                    <option><?= $item['name'] ?></option>
                                </tr>
                            <?php } ?>	
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>
                        
                    <div class="mb-3 form-group">
                        <label class="control-label">Komisi</label>
                        <input type="number" class="form-control" name="komisi">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                        <span class="font-13 text-muted">Max 1 MB</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn bg-stockism text-light btn-pill" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>