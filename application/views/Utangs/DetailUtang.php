<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Detail Utang</h5>
    </div>
    <div class="card-body m-3">
        <dl class="row">
            <dt class = "col-4">
                Invoice
            </dt>
            <dd class = "col-8">
                : <?= $incpurchaseorder->invoice_po; ?>
            </dd>
            <dt class = "col-4">
                Total Item
            </dt>
            <dd class = "col-8">
                : <?= $incpurchaseorderproduct->num_rows(); ?>
            </dd>
            <dt class = "col-4">
                Total Item Price
            </dt>
            <dd class = "col-8">
                : <?php
                $subtotal = 0;
                foreach ($incpurchaseorderproduct->result() as $poproduct) {
                    $subtotal = $subtotal + $poproduct->subtotal;
                }
                echo $subtotal;
                ?>
            </dd>
            <dt class = "col-4">
                Tax Cost
            </dt>
            <dd class = "col-8">
                : <?= $incpurchaseorder->tax_cost ?>
            </dd>
            <dt class = "col-4">
                Shipping Cost
            </dt>
            <dd class = "col-8">
                : <?= $incpurchaseorder->shipping_cost; ?>
            </dd>
            <dt class = "col-4">
                Total Utang
            </dt>
            <dd class = "col-8">
                : <?= $masutang->total_utang; ?>
            </dd>
            <dt class = "col-4">
                Total Terbayar
            </dt>
            <dd class = "col-8">
                : <?= $masutang->sum_payment_price; ?>
            </dd>
            <dt class = "col-4">
                Date Due
            </dt>
            <dd class = "col-8">
                : <?= date_format(date_create($masutang->date_created), "d-m-Y") ?>
            </dd>
        </dl>    
    </div>
</div>