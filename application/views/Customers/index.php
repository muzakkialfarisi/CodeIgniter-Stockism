<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Customers</h5>
            </div>

            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#Modal">Create New</button>
            <?php $this->load->view("Customers/Create.php") ?>

        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Customer Type</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Tenant Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mascustomer as $item) { ?>
                        <tr>
                            <td><?= $item['id_customer'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <?php   if ($item['id_customertype'] == 1) { ?>
                                <td>Reguler</td>
                            <?php } if ($item['id_customertype'] == 2) { ?>
                                <td>Dropshiper</td>
                            <?php } if ($item['id_customertype'] == 3) { ?>
                                <td>Distributor</td>
                            <?php } ?>
                            <!-- <td><?= $item['id_customertype'] ?></td> -->
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['email_tenant'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>
