<div class="card">
    <div class="card-body m-3">
        <div class="table-responsive" style="width:100%">
            <table class="table table-hover" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Product</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($masproduct as $item) { ?>
                        <tr data-id="<?= $item['id_product'] ?>">
                            <td>
                            <div class="row">
                                <div class="col-4">
                                    <img src="<?= base_url(); ?>assets/img/products/<?= $item['picture'] ?>" class="img-thumbnail" height="60" width="60" asp-append-version="true"/>
                                </div>
                                <div class="col-8">
                                    <?= $item['sku'] ?><br>
                                    <?= $item['name'] ?>
                                </div>
                            </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-8">
                                        <?= $item['quantity'] ?><br>
                                        <div style="font-size:10px">
                                            <?php if($item['quantity'] == 0) { ?>
                                                <span class="text-danger">Stok Habis</span>
                                            <?php } elseif($item['quantity'] <= $item['minimum_stock']) {?>
                                                <span class="text-warning">Stok Menipis</span>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-fw fa-angle-double-right"></i>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    <?php
                    $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>