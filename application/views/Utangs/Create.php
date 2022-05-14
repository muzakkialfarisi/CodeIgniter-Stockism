<div class="modal fade" id="ModalCreate" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form action="<?= site_url('ProductUnits/CreatePost') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Product Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <?php echo validation_errors(); ?>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>