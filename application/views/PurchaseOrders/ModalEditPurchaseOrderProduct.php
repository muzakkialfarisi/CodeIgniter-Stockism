<div class="modal fade" id="ModalEditPurchaseOrderProduct" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bach SKU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('PurchaseOrders/EditPurchaseOrderProductPost') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <input type="text" class="form-control" name="id_po" required hidden>
                    <input type="text" class="form-control" name="id_poproduct" required hidden>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Batch SKU</label>
                        <input type="text" class="form-control" name="sku" required readonly>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Purchase Price</label>
                        <input type="text" class="form-control" name="purchase_price" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="control-label">Expired Date</label>
                        <input type="datetime-local" class="form-control" name="expired_date"/>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Storage</label>
                        <input type="text" class="form-control" name="storage">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button class="btn bg-stockism text-white btn-md btn-pill" type="submit">Save</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>