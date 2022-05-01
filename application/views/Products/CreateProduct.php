<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Create New Product</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group">
                    <label class="control-label">Picture</label>
                    <input type="file" accept="image/*" class="form-control" name="picture">
                    <small class="form-text d-block text-muted">Max 500 kb.</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 text-center">
                <img src="<?= base_url(); ?>/assets/img/avatars/default-avatar.png" class="img-thumbnail" height="60" width="60" asp-append-version="true"/>
            </div>
        </div>

        <div class="mb-3 form-group required">
            <label class="control-label">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">First Stock</label>
                    <input type="number" class="form-control" name="quantity" value ="0" required>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Item</label>
                    <div class="input-group">
                        <select class="form-select flex-grow-1" name="id_productunit">
                            <option selected disabled>Select...</option>
                            <?php foreach($masproductunit as $item) { ?>}
                                <option value="<?= $item['id_productunit'] ?>"><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <a href="<?= site_url('ProductUnits') ?>" class="btn bg-stockism text-light" type="button">Add!</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Purchase Price</label>
                    <input type="text" class="form-control" name="purchase_price" required>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="mb-3 form-group required">
                    <label class="control-label">Selling Price</label>
                    <input type="text" class="form-control" name="selling_price" required>
                </div>
            </div>
        </div>

        <div class="mb-3 form-group required">
            <label class="control-label">Category</label>
            <div class="input-group">
                <select class="form-select flex-grow-1" name="id_productcategory">
                    <option disabled selected>Select...</option>
                    <?php foreach($masproductcategory as $item) { ?>}
                        <option value="<?= $item['id_productcategory'] ?>"><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
                <a href="<?= site_url('ProductCategories') ?>" class="btn bg-stockism text-light" type="button">Add!</a>
            </div>
        </div>

    </div>
</div>