<div class="card">
    <div class="card-header bg-stockism">
        <h5 class="card-title mb-0 text-light">Sales Order Products</h5>
    </div>
    <div class="card-body m-3">
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Product</th>
                        <th>Sales Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($outsalesorderproduct as $item) { ?>
                        <tr>
                            <td>
                                <?php 
                                    $id_product = $item['id_product'];
                                    $product = $this->db->query("SELECT * FROM masproduct where id_product = '$id_product'")->row();
                                ?>
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?= base_url(); ?>assets/img/products/<?= $product->picture ?>" class="img-thumbnail" height="60" width="60" asp-append-version="true"/>
                                    </div>
                                    <div class="col-8">
                                        <?= $product->name ?>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <?= number_format($item['selling_price']) ?>     
                            </td>
                            <td class="text-center">
                                <?= $item['quantity'] ?>     
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>