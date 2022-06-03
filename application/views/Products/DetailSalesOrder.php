<h4 class="tab-title mb-5">Sales Order Histories</h4>
<div class="table-responsive" style="width:100%">
    <table class="table table-striped" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>Date</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach($outsalesorderproduct as $item) { ?>
                <tr>
                    <td><?= date_format(date_create($item['date_created']), "d-m-Y") ?></td>
                    <td class="text-end"><?= number_format($item['selling_price']) ?></td>
                    <td class="text-center"><?= $item['quantity'] ?></td>
                    <td class="text-end"><?= number_format($item['subtotal']) ?></td>
                </tr>
            <?php
            $i++; } ?>
        </tbody>
    </table>
</div>