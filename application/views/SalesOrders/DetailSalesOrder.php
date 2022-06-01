<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light"> Sales Order</h5>
    </div>
    <div class="card-body m-3">
        <div class="row">
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
                    : <?php
                        $date_created = $outsalesorder->date_created;
                        echo date("d-m-Y", strtotime($date_created)).' '.date("H:i:s", strtotime($date_created));
                    ?>
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
    </div>
</div>