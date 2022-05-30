<div class="modal fade" id="ModalEditStatus" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('SalesOrders/EditSalesOrderStatusPost') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <input type="text" class="form-control" name="id_so" required hidden>
                    <div class="mb-3 form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label fw-bold">Payment</label>
                            </div>
                            <div class="col">
                                <input name="status_payment" value="Debt" type="radio" class="form-check-input" id="status_payment0"> Debt
                            </div>
                            <div class="col">
                                <input name="status_payment" value="Paid" type="radio" class="form-check-input" id="status_payment1"> Paid
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label fw-bold">Delivery</label>
                            </div>
                            <div class="col">
                                <input name="status_delivery" value="On Going" type="radio" class="form-check-input" id="status_delivery0"> On Going
                            </div>
                            <div class="col">
                                <input name="status_delivery" value="Done" type="radio" class="form-check-input" id="status_delivery1"> Done
                            </div>
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