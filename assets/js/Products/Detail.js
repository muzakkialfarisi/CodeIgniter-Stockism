$('.btn-edit-purchaseorderproduct').on('click', function(){
    $.ajax({
        type: 'POST',
        url: '/stockism/PurchaseOrderProducts/GetPurchaseOrderProductById',
        data: {
            id_poproduct: $(this).data("id"),
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("input[name='id_product']").val(data.id_product);
            $("input[name='id_poproduct']").val(data.id_poproduct);
            $("input[name='sku']").val(data.sku);
            $("input[name='purchase_price']").val(data.purchase_price);
            $("input[name='expired_date']").val(data.expired_date);
            $("input[name='storage']").val(data.storage);
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$(".table").DataTable({
});