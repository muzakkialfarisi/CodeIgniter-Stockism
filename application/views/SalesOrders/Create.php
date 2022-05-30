<form action="<?= site_url('SalesOrders/CreatePost') ?>" method="post">

    <?php $this->load->view("SalesOrders/CreateSalesOrder.php") ?>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab" id="btn-salesdetails">Sales Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab" id="btn-addproduct1">Products</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                        <?php $this->load->view("SalesOrders/CreateSalesOrderPayment.php") ?>
                        <?php $this->load->view("SalesOrders/CreateSalesOrderDelivery.php") ?>
                        <?php $this->load->view("SalesOrders/CreateSalesOrderChannel.php") ?>
                        <?php $this->load->view("SalesOrders/CreateSalesOrderCustomer.php") ?>
                    </div>
                    <div class="tab-pane" id="tab-2" role="tabpanel">
                        <?php $this->load->view("SalesOrders/ListProduct.php") ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <?php $this->load->view("PurchaseOrders/CreatePurchaseOrderProduct.php") ?>
        </div>
    </div>
    <div class="form-group text-end">
        <a href="<?= site_url('PurchaseOrders/Index') ?>" class="btn btn-light btn-pill">Back to List</a>
        <button type="submit" class="btn bg-stockism text-light btn-pill">Save</button>
    </div>

</form>