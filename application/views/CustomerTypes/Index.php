<div class="card">
    <div class="card-header bg-stockism">
        <div class="d-flex align-items-center py-1">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title mb-0 text-light">Customers Type</h5>
            </div>

            <button type="button" class="btn btn-light btn-pill" data-bs-toggle="modal" data-bs-target="#Modal">Create New</button>
            <?php $this->load->view("CustomerTypes/Create.php") ?>

        </div>
    </div>
    <div class="card-body m-3">
        
        <div class="table-responsive" style="width:100%">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mascustomertype as $item) { ?>
                        <tr>
                            <td><?= $item['Id_CustomerType'] ?></td>
                            <td><?= $item['name'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
    </div>
</div>
