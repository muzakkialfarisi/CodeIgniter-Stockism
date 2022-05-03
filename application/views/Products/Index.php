<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Product Categories</h5>
            </div>
            <a type="button" class="btn btn-light btn-pill" href="<?= site_url('Products/Create') ?>">Create New</a>
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
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
                            <td><?= $item['sku'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['purchase_price'] ?></td>
                            <td><?= $item['selling_price'] ?></td>
                            <td><?= $item['selling_price'] ?></td>
                            <td><?= $item['status'] ?></td>
                            <?php if($this->session->userdata['logged_in']['id_usertype'] == "Admin"){ ?>
                                <td><?= $item['email_tenant'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn bg-light dropdown-toggle" type="button" id="dropdownactions" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownactions">
                                        <li><button type="button" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="<?= $item['id_productunit'] ?>" data-bs-target="#ModalEdit">Edit</button></li>
                                        <li><a href="<?= site_url('Products/Detail/'.$item['id_product']) ?>" type="button" class="dropdown-item" data-id="<?= $item['id_product'] ?>">Details</a></li>
                                        <li><button type="button" class="dropdown-item btn-delete text-danger" data-id="<?= $item['id_productunit'] ?>">Delete</button></li>
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