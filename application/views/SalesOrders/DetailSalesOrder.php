<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light"> Sales Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-11">    
                <dl class="row">
                    <dt class = "col-4">
                        Created By
                    </dt>
                    <dd class = "col-8">
                        : <?= $outsalesorder->createby; ?>
                    </dd>
                    <dt class = "col-4">
                        Customer
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo $this->db->query("SELECT * FROM mascustomer where id_customer = '$outsalesorder->id_customer'")->row()->name;  
                        ?>
                    </dd>
                    <dt class = "col-4">
                        Date Created
                    </dt>
                    <dd class = "col-8">
                        : <?= $outsalesorder->date_created; ?>
                    </dd>
                    <dt class = "col-4">
                        Invoice
                    </dt>
                    <dd class = "col-8">
                        : <?= $outsalesorder->invoice_so; ?>
                    </dd>
                    <dt class = "col-4">
                        Shipping Cost
                    </dt>
                    <dd class = "col-8">
                        : <?= $outsalesorder->shipping_cost; ?>
                    </dd>
                    <dt class = "col-4">
                        Tax Cost
                    </dt>
                    <dd class = "col-8">
                        : <?= $outsalesorder->tax_cost; ?>
                    </dd>
                    <hr class="mt-2">
                    <dt class = "col-4">
                        Item
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo $this->db->query("SELECT * FROM outsalesorderproduct where id_so = '$outsalesorder->id_so'")->num_rows();  
                        ?>
                    </dd>
                    <dt class = "col-4">
                        Total
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo number_format($this->db->query("SELECT SUM(subtotal) AS sumsubtotal FROM outsalesorderproduct where id_so = '$outsalesorder->id_so'")->row()->sumsubtotal);  
                        ?>
                    </dd>
                </dl>      
            </div>
            <div class="col-12 col-sm-1">    
                <button class="btn btn-sm text-primary" data-id="<?= $outsalesorder->id_so; ?>" data-bs-toggle="modal" data-bs-target="#ModalEditPurchaseOrder"><i class="align-middle me-2 fas fa-fw fa-edit"></i></button>      
            </div>
        </div>
    </div>
</div>