<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Products</h5>
            </div>
            <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                <a type="button" class="btn btn-light btn-pill" href="<?= site_url('Products/Create') ?>">Create New</a>
            <?php } ?>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Picture</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                            <th>Tenant</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($masproduct as $item) { ?>
                        <tr>
                            <td><img src="<?= base_url(); ?>assets/img/products/<?=$item['picture'] ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/></td>
                            <td><?= $item['sku'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td class="text-end"><?= number_format($item['purchase_price']) ?></td>
                            <td class="text-end"><?= number_format($item['selling_price']) ?></td>
                            <td>
                                <?= $item['quantity'] ?><br>
                                <div style="font-size:10px">
                                    <?php if($item['quantity'] == 0) { ?>
                                        <span class="text-danger">Stok Habis</span>
                                    <?php } elseif($item['quantity'] <= $item['minimum_stock']) {?>
                                        <span class="text-warning">Stok Menipis</span>
                                    <?php }?>
                                </div>
                            </td>
                            <td class="text-center"><?= $item['status'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="dropstart">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><a href="<?= site_url('Products/Detail/'.$item['id_product']) ?>" type="button" class="dropdown-item">Details</a></li>
                                        <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin"){ ?>
                                            <li><a href="<?= site_url('Products/Edit/'.$item['id_product']) ?>" type="button" class="dropdown-item btn-edit">Edit</a></li>
                                            <?php if($item['status'] == "Active") { ?>
                                                <li><button type="button" class="dropdown-item btn-activator text-warning" data-id="<?= $item['id_productunit'] ?>" data-value="<?= $item['status'] ?>">Deactivate</button></li>
                                            <?php } else { ?>
                                                <li><button type="button" class="dropdown-item btn-activator text-success" data-id="<?= $item['id_productunit'] ?>" data-value="<?= $item['status'] ?>">Activate</button></li>
                                            <?php } ?>
                                            <li><button type="button" class="dropdown-item btn-delete text-danger" data-id="<?= $item['id_productunit'] ?>">Delete</button></li>
                                        <?php } ?>
                                    </ul>
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

<form action="<?= site_url('Products/DeletePost') ?>" method="post" id="DeletePost">
    <input type="text" class="form-control" name="id_product" required hidden>
</form>