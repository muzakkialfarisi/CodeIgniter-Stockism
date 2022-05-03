<div class="card">
    <div class="card-header m-3">
        <div class="row">
            <div class="col-12 col-sm-3 text-center">
                <img src="<?= base_url(); ?>assets/img/products/<?= $masproduct->picture; ?>" class="rounded-circle" height="60" width="60" asp-append-version="true"/>
            </div>
            <div class="col-11 col-sm-8">
                <strong><?= $masproduct->name; ?></strong> <br>
                <div class="row">
                    <div class="col-3 text-primary">
                        SKU
                    </div>
                    <div class="col-9">
                        <?= $masproduct->sku; ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-3 text-primary">
                        Code
                    </div>
                    <div class="col-9">
                        <?= $masproduct->code; ?>
                    </div>
                </div>
            </div>
            <div class="col-1 col-sm-1">
                <a href="<?= site_url('Products/Edit/'.$masproduct->id_product) ?>"><i class="align-middle me-2 fas fa-fw fa-edit"></i></a>
            </div>
        </div>  
    </div>
    <div class="card-body m-3">
        <dl class="row">
            <dt class = "col-sm-4">
                Stock
            </dt>
            <dd class = "col-sm-8">
                : @Model.incDeliveryOrder.MasDataTenant.Name
            </dd>
            <dt class = "col-sm-4">
                Unit
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproductunit->name; ?>
            </dd>
            <dt class = "col-sm-4">
                Purchase Price
            </dt>
            <dd class = "col-sm-8">
                : <?= number_format($masproduct->purchase_price); ?>
            </dd>
            <dt class = "col-sm-4">
                Selling Price
            </dt>
            <dd class = "col-sm-8">
                : <?= number_format($masproduct->selling_price); ?>
            </dd>
            <dt class = "col-sm-4">
                Category
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproductcategory->name; ?>
            </dd>
            <dt class = "col-sm-4">
                Size (Cm)
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproduct->panjang; ?> x <?= $masproduct->lebar; ?> x <?= $masproduct->tinggi; ?>
            </dd>
            <dt class = "col-sm-4">
                Actual Weight
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproduct->actual_weight; ?> Gram
            </dd>
            <dt class = "col-sm-4">
                Vol Weight
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproduct->vol_weight; ?> Gram
            </dd>
            <dt class = "col-sm-4">
                Description
            </dt>
            <dd class = "col-sm-8">
                : <?= $masproduct->description; ?>
            </dd>
        </dl>
    </div>
</div>