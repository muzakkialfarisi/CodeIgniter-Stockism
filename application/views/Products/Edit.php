<form action="<?= site_url('Products/EditPost') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-6">
            <input type="hidden" name="id_product">
            <?php $this->load->view("Products/CreateProduct.php") ?>
            <?php $this->load->view("Products/CreateProductCode.php") ?>
        </div>
        <div class="col-12 col-sm-6">
            <?php $this->load->view("Products/CreateProductStorage.php") ?>
            <?php $this->load->view("Products/CreateProductVariant.php") ?>
        </div>
    </div>
    <div class="form-group text-end">
        <a href="<?= site_url('Products/Index') ?>" class="btn btn-light btn-pill">Back to List</a>
        <button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
    </div>
</form>
