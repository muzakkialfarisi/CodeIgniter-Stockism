$('.date_due').hide();
$('.toko').hide();
$('.tax_cost').hide();
// $('.airway_bill').hide();
$("select[name='status_payment']").change(function(e){
    if($(this).val() == "Paid"){
        $('.date_due').hide();
    }else{
        $('.date_due').show();
    }
});

$("select[name='id_marketplace']").change(function(e){
    if($(this).val() == ""){
        $('.toko').hide();
    }else{
        $('.toko').show();
        // $data['masstoremarketplace'] = $this->MasStore->GetStoreByMarketplace($data['masmarketplace']->id_marketplace)->row();
    }
});

$("select[name='id_toko']").change(function(e){
    if($(this).val() == ""){
        $('.tax_cost').hide();
    }else{
        $('.tax_cost').show();
    }
});



var index = 0;
$('.table tbody tr').click(function () {
    //console.log($(this).data("id"));
    if ($("#id_product"+$(this).data("id")).val() == null)
    {
        $.ajax({
            type: 'POST',
            url: '/stockism/Products/GetProductById/',
            data: {
                id_product: $(this).data("id"),
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var row =   '<div class="rec-element mb-3">'+
                                '<div class="row mb-3">'+ 
                                    '<div class="col-12 col-sm-3 text-center">'+ 
                                            '<img src="/stockism/assets/img/products/'+ data.picture +'" class="rounded-circle" height="60" width="60" asp-append-version="true"/>'+ 
                                    '</div>'+ 
                                    '<div class="col-11 col-sm-8">'+ 
                                        '<div class="mb-2">'+ 
                                            '<strong>'+ data.name +'</strong> <br>'+ 
                                            '<input type="hidden" class="form-control number-only" name="id_product[]" id="id_product'+data.id_product+'" value="'+ data.id_product +'">'+
                                        '</div>'+ 
                                        '<div class="row">'+ 
                                            '<div class="col-4 text-primary">'+ 
                                                'SKU'+ 
                                            '</div>'+ 
                                            '<div class="col-8">'+ 
                                                data.sku + 
                                            '</div>'+ 
                                        '</div> '+ 
                                    '</div>'+ 
                                    '<div class="col-1 col-sm-1">'+ 
                                        '<a class="del-element"><i class="align-middle me-2 fas fa-fw fa-trash"></i></a>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                                '<div class="row">'+
                                    '<div class="col-12 col-sm-6">'+
                                        '<div class="mb-3 form-group required">'+
                                            '<label class="control-label">Quantity</label>'+
                                            '<input type="number" class="form-control number-only" name="quantity[]" id="quantity'+index+'" value="1" min="1" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-12 col-sm-6">'+
                                        '<div class="mb-3 form-group required">'+
                                            '<label class="control-label">Selling Price</label>'+
                                            '<input type="number" class="form-control number-only" name="selling_price[]" id="selling_price'+index+'" value="'+data.selling_price+'" required>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<hr>'+
                            '</div>';
                $(row).insertBefore("#nextkolom");
                $('#jumlahkolom').val(index+1);
                index++;
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }
});

$(document).on('click','.del-element',function (e) {        
    e.preventDefault()
    index--;
    //$(this).parents('.rec-element').fadeOut(400);
    $(this).parents('.rec-element').remove();
    $('#jumlahkolom').val(index-1);
}); 

$(".table").DataTable({
    lengthMenu: [
        [5, 10, 25, 50],
        [5, 10, 25, 50],
    ],
    pageLength: 5,
});