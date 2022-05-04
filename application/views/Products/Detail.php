<div class="row">
    <div class="col-12 col-lg-5">
        <?php $this->load->view("Products/DetailProduct.php") ?>
        <?php $this->load->view("Products/ModalQRCode.php") ?>
    </div>
    <div class="col-12 col-lg-7">
        <div class="card bg-transparent">
            <div class="tab m-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#purchaseorder" data-bs-toggle="tab" role="tab" aria-selected="false">Purchase Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab" aria-selected="false">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab" role="tab" aria-selected="true">Messages</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="purchaseorder" role="tabpanel">
                        <?php $this->load->view("Products/DetailPurchaseOrder.php") ?>
                    </div>
                    <div class="tab-pane" id="tab-2" role="tabpanel">
                        <h4 class="tab-title">Another one</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                            rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                        </p>
                        <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                            justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                            justo.</p>
                    </div>
                    <div class="tab-pane" id="tab-3" role="tabpanel">
                        <h4 class="tab-title">One more</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                            rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                        </p>
                        <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                            justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                            justo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
