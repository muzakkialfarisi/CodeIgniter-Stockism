<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3 my-1">
                <h5 class="card-title mb-0 text-light">Detail Utang</h5>
            </div>
        </div>
    </div>
    <div class="card-body m-3">
        <dl class="row">
            <dt class = "col-4">
                Invoice
            </dt>
            <dd class = "col-8">
                : <?= $outsalesorder->invoice_po; ?>
            </dd>
            <dt class = "col-4">
                Total Item
            </dt>
            <dd class = "col-8">
                : <?= $outsalesorderproducts->num_rows(); ?>
            </dd>
            <dt class = "col-4">
                Total Item Price
            </dt>
            <dd class = "col-8">
                : <?php
                $subtotal = 0;
                foreach ($outsalesorderproducts->result() as $soproduct) {
                    $subtotal = $subtotal + $soproduct->subtotal;
                }
                echo number_format($subtotal);
                ?>
            </dd>
            <dt class = "col-4">
                Tax Cost
            </dt>
            <dd class = "col-8">
                : <?= number_format($outsalesorder->tax_cost) ?>
            </dd>
            <dt class = "col-4">
                Shipping Cost
            </dt>
            <dd class = "col-8">
                : <?= number_format($outsalesorder->shipping_cost); ?>
            </dd>
            <dt class = "col-4">
                Total Utang
            </dt>
            <dd class = "col-8">
                : <?= number_format($maspiutang->total_piutang); ?>
            </dd>
            <dt class = "col-4">
                Total Terbayar
            </dt>
            <dd class = "col-8">
                : <?= number_format($maspiutang->sum_payment_price); ?>
            </dd>
            <dt class = "col-4">
                Date Due
            </dt>
            <dd class = "col-8">
                : <?= date_format(date_create($maspiutang->date_created), "d-m-Y") ?>
            </dd>
        </dl>    
    </div>
</div>