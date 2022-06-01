<div class="modal fade" id="ModalEditPurchaseOrderProductQuantity" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('PurchaseOrderProducts/EditPurchaseOrderProductQuantityPost') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <input name="id_po" required hidden>
                    <div id="nextkolom" name="nextkolom"></div>
                    <button type="button" id="jumlahkolom" value="0" style="display:none"></button>
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