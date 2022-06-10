<div class="modal fade" id="ModalAddPayment" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Utangs/EditUtangAngsuranPost') ?>" method="post">
                <?php echo validation_errors(); ?>
                <div class="modal-body m-3">
                    <input type="text" class="form-control" name="id_po" required hidden>
                    <input type="text" class="form-control" name="type" required hidden>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Date Paid</label>
                        <input type="datetime-local" class="form-control" name="date_created" required>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_payment" value="Debt" checked>
                                <label class="form-check-label">
                                    Installment
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_payment" value="Paid">
                                <label class="form-check-label">
                                    Paid
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-group required">
                        <label class="control-label">Payment Price</label>
                        <input type="number" class="form-control number-only" name="payment_price" required>
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