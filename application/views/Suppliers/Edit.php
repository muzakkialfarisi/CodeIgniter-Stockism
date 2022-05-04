<div class="modal fade" id="ModalEdit" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Suppliers/EditPost') ?>" method="post">
                <?php echo validation_errors(); ?>

                <div class="modal-body m-3">
                    <input type="text" class="form-control" name="id_supplier" required hidden>
                    <input type="text" class="form-control" name="email_tenant" required hidden>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group required">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email">
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group required">
                                <label class="control-label">Nomor Whatsapp</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">+62</span>
                                    <input type="text" class="form-control" placeholder="80123456789" name="phone_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="control-label">Address</label>
                                <textarea class="form-control" rows="3" name="address"></textarea>
                            </div>
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