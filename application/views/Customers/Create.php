<div class="modal fade" id="Modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('Customers/AddCustomerProcess') ?>" method="post">
                <?php echo validation_errors(); ?>

                <div class="modal-body m-3">
                    <div class="mb-3 form-group required">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3 form-group required">
                        <label class="control-label">Customer Type</label>
                        <select class="form-control mb-3" name="Id_CustType" required>
							<?php foreach($mascustomertype as $item) { ?>
                                <tr>
                                    <option><?= $item['name'] ?></option>
                                </tr>
                            <?php } ?>
							
						</select>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Nomor Whatsapp</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">+62</span>
                            <input type="text" class="form-control" placeholder="80123456789" name="phone_number">
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="control-label">Address</label>
                        <textarea class="form-control" rows="3" name="address"></textarea>
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