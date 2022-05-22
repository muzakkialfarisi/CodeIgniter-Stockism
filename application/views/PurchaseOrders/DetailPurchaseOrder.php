<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light"> Purchase Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
            <div class="col-12 col-sm-11">    
                <dl class="row">
                    <dt class = "col-4">
                        Created By
                    </dt>
                    <dd class = "col-8">
                        : <?= $incpurchaseorder->createdby; ?>
                    </dd>
                    <dt class = "col-4">
                        Supplier
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo $this->db->query("SELECT * FROM massupplier where id_supplier = '$incpurchaseorder->id_supplier'")->row()->name;  
                        ?>
                    </dd>
                    <dt class = "col-4">
                        Gudang
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo $this->db->query("SELECT * FROM maswarehouse where id_warehouse = '$incpurchaseorder->id_warehouse'")->row()->name;  
                        ?>
                    </dd>
                    <dt class = "col-4">
                        Date Created
                    </dt>
                    <dd class = "col-8">
                        : <?= $incpurchaseorder->date_created; ?>
                    </dd>
                    <dt class = "col-4">
                        Invoice
                    </dt>
                    <dd class = "col-8">
                        : <?= $incpurchaseorder->invoice_po; ?>
                    </dd>
                    <dt class = "col-4">
                        Shipping Cost
                    </dt>
                    <dd class = "col-8">
                        : <?= $incpurchaseorder->shipping_cost; ?>
                    </dd>
                    <dt class = "col-4">
                        Tax Cost
                    </dt>
                    <dd class = "col-8">
                        : <?= $incpurchaseorder->tax_cost; ?>
                    </dd>
                    <hr class="mt-2">
                    <dt class = "col-4">
                        Item
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo $this->db->query("SELECT * FROM incpurchaseorderproduct where id_po = '$incpurchaseorder->id_po'")->num_rows();  
                        ?>
                    </dd>
                    <dt class = "col-4">
                        Total
                    </dt>
                    <dd class = "col-8">
                        : <?php
                        echo number_format($this->db->query("SELECT SUM(subtotal) AS sumsubtotal FROM incpurchaseorderproduct where id_po = '$incpurchaseorder->id_po'")->row()->sumsubtotal);  
                        ?>
                    </dd>
                </dl>      
            </div>
            <div class="col-12 col-sm-1">    
                <button class="btn btn-sm text-primary btn-edit-purchaseorder" data-id="<?= $incpurchaseorder->id_po; ?>" data-bs-toggle="modal" data-bs-target="#ModalEditPurchaseOrder"><i class="align-middle me-2 fas fa-fw fa-edit"></i></button>      
            </div>
        </div>
    </div>
</div>