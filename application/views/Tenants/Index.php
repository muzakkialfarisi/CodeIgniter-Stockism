<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Tenants</h5>
            </div>
            <!-- <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#ModalCreate">Create New</button> -->
        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mastenant as $item) { ?>
                        <tr>
                            <td>
                                <img src="<?= base_url(); ?>assets/img/avatars/<?=$item['picture'] ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/>
                            </td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['address'] ?></td>
                            <td><?= $item['phone_number'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>



