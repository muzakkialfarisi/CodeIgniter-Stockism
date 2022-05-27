<div class="modal fade" id="ModalEditPurchaseOrder" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bach SKU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('PurchaseOrders/EditPurchaseOrderPost') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <input type="text" class="form-control" name="id_po" value="<?php if (isset($incpurchaseorder)) { echo $incpurchaseorder->id_po; }?>" hidden>
                    <div class="row">
                        <?php $this->load->view("PurchaseOrders/CreatePurchaseOrder.php") ?>
                        <div class="col-12 col-sm-4">
                            <?php $this->load->view("PurchaseOrders/CreatePurchaseOrderPayment.php") ?>
                        </div>
                        <div class="col-12 col-sm-4">
                            <?php $this->load->view("PurchaseOrders/CreatePurchaseOrderDelivery.php") ?>
                        </div>
                        <div class="col-12 col-sm-4">
                            <?php $this->load->view("PurchaseOrders/CreatePurchaseOrderSupplier.php") ?>
                        </div>
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