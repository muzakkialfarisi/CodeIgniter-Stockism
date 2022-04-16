<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Stores</h5>
            </div>

            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#Modal">Create New</button>
            <?php $this->load->view("Stores/Create.php") ?>
    
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Komisi</th>
                        <th>Photo</th>
                        <th>Marketplace</th>
                        <th>Email Tenant</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mastoko as $item) { ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                            <td><?= $item['komisi'] ?> %</td>
                            <td><?= $item['photo'] ?></td>
                            <?php   if ($item['id_marketplace'] == 1) { ?>
                                <td>Tokopedia</td>
                            <?php } if ($item['id_marketplace'] == 2) { ?>
                                <td>Bukalapak</td>
                            <?php } ?>
                            <td><?= $item['email_tenant'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>



